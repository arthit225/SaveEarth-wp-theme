<?php

use RebelCode\Iris\Aggregator\AggregateResult;
use RebelCode\Iris\Data\Item;
use RebelCode\Iris\Data\Source;
use RebelCode\Iris\Engine;
use RebelCode\Spotlight\Instagram\Engine\Data\Feed\StoryFeed;
use RebelCode\Spotlight\Instagram\Engine\Data\Item\MediaChild;
use RebelCode\Spotlight\Instagram\Engine\Data\Item\MediaComment;
use RebelCode\Spotlight\Instagram\Engine\Data\Item\MediaItem;
use RebelCode\Spotlight\Instagram\Feeds\Feed;
use RebelCode\Spotlight\Instagram\Feeds\FeedManager;
use RebelCode\Spotlight\Instagram\IgApi\IgComment;
use RebelCode\Spotlight\Instagram\MediaStore\IgCachedMedia;
use RebelCode\Spotlight\Instagram\MediaStore\MediaSource;
use RebelCode\Spotlight\Instagram\PostTypes\FeedPostType;
use RebelCode\Spotlight\Instagram\Utils\Arrays;
use RebelCode\Spotlight\Instagram\Wp\PostType;

/**
 * The Spotlight Instagram Developer API.
 *
 * A simple class that exposes common functionality for developers, themes and other integrations.
 *
 * @since 0.3.2
 */
class SpotlightInstagram
{
    /**
     * @since 0.3.2
     *
     * @param int $feedId The ID of the feed.
     * @param int|null $num The number of media items to return. Will return everything if null or less than zero.
     * @param int $offset The offset from which to begin returning media. Negative values will be treated as zero.
     *
     * @return IgCachedMedia[]
     */
    public static function getFeedMedia(int $feedId, ?int $num = -1, int $offset = 0)
    {
        return static::aggregateItems($feedId, $num < 0 ? null : $num, $offset);
    }

    /**
     * @since 0.3.2
     *
     * @param int $feedId The ID of the feed.
     *
     * @return IgCachedMedia[]
     */
    public static function getFeedStories(int $feedId)
    {
        return static::aggregateItems($feedId, null, 0, true);
    }

    /**
     * Retrieves a Spotlight Instagram feed for a given ID.
     *
     * @since 0.4
     *
     * @param int $feedId The ID of the feed to retrieve.
     *
     * @return Feed|null The feed, or null if the given ID does not correspond to a feed.
     */
    public static function getFeed(int $feedId): ?Feed
    {
        $plugin = spotlightInsta();

        /* @var $feeds PostType */
        $feeds = $plugin->get("feeds/cpt");
        $post = $feeds->get($feedId);

        return $post instanceof WP_Post
            ? FeedPostType::fromWpPost($post)
            : null;
    }

    /**
     * Common functionality for {@link getFeedMedia()} and {@link getStoryMedia()}.
     *
     * @since 0.9
     */
    protected static function aggregateItems($feedId, ?int $count = null, int $offset = 0, bool $stories = false): array
    {
        $count = $count < 0 ? null : $count;
        $offset = max(0, $offset);

        $plugin = spotlightInsta();

        /* @var $engine Engine */
        /* @var $feedManager FeedManager */
        $engine = $plugin->get('engine/instance');
        $feedManager = $plugin->get("feeds/manager");

        $feed = $feedManager->get($feedId);
        if ($feed === null) {
            return [];
        }

        if ($stories) {
            $feed = StoryFeed::createFromFeed($feed);
        }

        $result = ($feed !== null)
            ? $engine->getAggregator()->aggregate($feed, $count, $offset)
            : new AggregateResult([], 0, 0, 0);

        return Arrays::map($result->items, function ($item) {
            return static::convertItem($item);
        });
    }

    /**
     * Converts an item from the Iris engine into a legacy media object instance.
     */
    protected static function convertItem(Item $item): IgCachedMedia
    {
        $sources = Arrays::map($item->sources, function ($source) {
            return static::convertSource($source);
        });

        $media = new IgCachedMedia();
        $media->id = $item->id;
        $media->username = $item->get(MediaItem::USERNAME);
        $media->timestamp = $item->get(MediaItem::TIMESTAMP);
        $media->caption = $item->get(MediaItem::CAPTION);
        $media->type = $item->get(MediaItem::MEDIA_TYPE);
        $media->url = $item->get(MediaItem::MEDIA_URL);
        $media->permalink = $item->get(MediaItem::PERMALINK);
        $media->shortcode = $item->get(MediaItem::SHORTCODE);
        $media->thumbnail = $item->get(MediaItem::THUMBNAIL_URL);
        $media->thumbnails = $item->get(MediaItem::THUMBNAILS);
        $media->likesCount = $item->get(MediaItem::LIKES_COUNT);
        $media->commentsCount = $item->get(MediaItem::COMMENTS_COUNT);
        $media->lastRequested = $item->get(MediaItem::LAST_REQUESTED);
        $media->source = $sources[0];
        $media->sources = $sources;
        $media->post = get_post($item->localId);

        $media->children = Arrays::map($item->get(MediaItem::CHILDREN, []), function (array $data) {
            $child = new IgCachedMedia();

            $child->id = $data[MediaChild::MEDIA_ID] ?? 0;
            $child->type = $data[MediaChild::MEDIA_TYPE] ?? '';
            $child->permalink = $data[MediaChild::PERMALINK] ?? '';
            $child->shortcode = $data[MediaChild::SHORTCODE] ?? '';
            $child->url = $data[MediaChild::MEDIA_URL] ?? '';

            return $child;
        });

        $media->comments = Arrays::map($item->get(MediaItem::COMMENTS, []), function (array $data) {
            $comment = new IgComment();
            $comment->id = $data[MediaComment::ID] ?? 0;
            $comment->username = $data[MediaComment::USERNAME] ?? '';
            $comment->text = $data[MediaComment::TEXT] ?? '';
            $comment->timestamp = $data[MediaComment::TIMESTAMP] ?? date(DATE_ISO8601);
            $comment->likeCount = $data[MediaComment::LIKES_COUNT] ?? 0;

            return $comment;
        });

        return $media;
    }

    /**
     * Converts a source from the Iris engine into a legacy source object instance.
     */
    protected static function convertSource(Source $source): MediaSource
    {
        $newSource = new MediaSource();
        $newSource->name = $source->id;
        $newSource->type = $source->type;

        return $newSource;
    }
}
