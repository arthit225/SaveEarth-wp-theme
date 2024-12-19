<?php

declare(strict_types=1);

namespace RebelCode\Spotlight\Instagram\Pro\Engine\Aggregator;

use RebelCode\Iris\Aggregator\ItemProcessor;
use RebelCode\Iris\Data\Feed;
use RebelCode\Iris\Store\Query;
use RebelCode\Spotlight\Instagram\Engine\Data\Feed\StoryFeed;
use RebelCode\Spotlight\Instagram\Engine\Data\Item\MediaItem;

class IncludeStoriesProcessor implements ItemProcessor
{
    public function process(array &$items, Feed $feed, Query $query): void
    {
        if ($feed->get('mediaType') === StoryFeed::MEDIA_TYPE) {
            $items = array_filter($items, [MediaItem::class, 'isValidStory']);
        }
    }
}
