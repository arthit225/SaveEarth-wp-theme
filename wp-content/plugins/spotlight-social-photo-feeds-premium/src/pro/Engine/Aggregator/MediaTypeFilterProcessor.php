<?php

namespace RebelCode\Spotlight\Instagram\Pro\Engine\Aggregator;

use RebelCode\Iris\Aggregator\ItemProcessor;
use RebelCode\Iris\Data\Feed;
use RebelCode\Iris\Data\Item;
use RebelCode\Iris\Store\Query;
use RebelCode\Spotlight\Instagram\Engine\Data\Feed\StoryFeed;
use RebelCode\Spotlight\Instagram\Engine\Data\Item\MediaItem;
use RebelCode\Spotlight\Instagram\Engine\Data\Item\MediaProductType;

/**
 * Filters media according to the feed's selected media type.
 */
class MediaTypeFilterProcessor implements ItemProcessor
{
    const ALL = "all";
    const PHOTOS = "photos";
    const REG_VIDEOS = "videos";
    const REELS_VIDEOS = "reels";
    const ALL_VIDEOS = "all_videos";

    /** @inheritDoc */
    public function process(array &$items, Feed $feed, Query $query): void
    {
        // Get the media type option from the feed's options
        $typeOption = $feed->get('mediaType', static::ALL);

        // Do nothing if the option is set to "all"
        if ($typeOption === static::ALL) {
            return;
        }

        // Handle the "stories" media type
        if ($feed->get('mediaType') === StoryFeed::MEDIA_TYPE) {
            $items = array_filter($items, [MediaItem::class, 'isValidStory']);
            return;
        }

        $bPhotos = $typeOption === static::PHOTOS;
        $bVideos = $typeOption === static::ALL_VIDEOS;
        $bRegVideos = $bVideos || $typeOption === static::REG_VIDEOS;
        $bReelVideos = $bVideos || $typeOption === static::REELS_VIDEOS;

        $items = array_filter($items, function (Item $item) use ($feed, $bPhotos, $bRegVideos, $bReelVideos) {
            $isVideo = $item->data[MediaItem::MEDIA_TYPE] === 'VIDEO';
            $isReelsVideo = $item->data[MediaItem::MEDIA_PRODUCT_TYPE] === MediaProductType::REELS;
            $isRegVideo = $isVideo && !$isReelsVideo;

            return (
                ($bPhotos && !$isVideo) ||
                ($bRegVideos && $isRegVideo) ||
                ($bReelVideos && $isReelsVideo)
            );
        });
    }
}
