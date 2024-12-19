<?php

namespace RebelCode\Spotlight\Instagram\Pro\Engine\Aggregator;

use RebelCode\Iris\Aggregator\ItemProcessor;
use RebelCode\Iris\Data\Feed;
use RebelCode\Iris\Data\Item;
use RebelCode\Iris\Store\Query;
use RebelCode\Spotlight\Instagram\Engine\Data\Item\MediaItem;

/**
 * Filters media according to a feed's moderation options.
 */
class ModerationFilterProcessor implements ItemProcessor
{
    /** @inheritDoc */
    public function process(array &$items, Feed $feed, Query $query): void
    {
        // Flip the array so that media IDs are array keys, enabling fast look up of IDs
        $moderation = array_flip($feed->get('moderation', []));

        $isBlacklist = $feed->get('moderationMode', 'blacklist') === "blacklist";

        // Do nothing if moderation is empty
        if ($isBlacklist && empty($moderation)) {
            return;
        }

        $items = array_filter($items, function (Item $item) use ($feed, $moderation, $isBlacklist) {
            $mediaId = $item->data[MediaItem::MEDIA_ID];

            return (
                // Allow media if mode is blacklist and the media is not in the moderation list
                ($isBlacklist && array_key_exists($mediaId, $moderation) === false) ||
                // Allow media if mode is whitelist and the media is in the moderation list
                (!$isBlacklist && array_key_exists($mediaId, $moderation) !== false)
            );
        });
    }
}
