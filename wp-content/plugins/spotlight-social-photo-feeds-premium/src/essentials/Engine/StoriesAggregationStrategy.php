<?php

namespace RebelCode\Spotlight\Instagram\Essentials\Engine;

use RebelCode\Iris\Aggregator\AggregationStrategy;
use RebelCode\Iris\Data\Feed;
use RebelCode\Iris\Store\Query;
use RebelCode\Iris\Store\Query\Condition;
use RebelCode\Spotlight\Instagram\Engine\Data\Feed\StoryFeed;
use RebelCode\Spotlight\Instagram\Engine\Data\Item\MediaProductType;
use RebelCode\Spotlight\Instagram\PostTypes\MediaPostType;

/**
 * A decorator aggregation strategy that adds support for story-only feeds.
 */
class StoriesAggregationStrategy implements AggregationStrategy
{
    /** @var AggregationStrategy */
    protected $inner;

    /** Constructor */
    public function __construct(AggregationStrategy $inner)
    {
        $this->inner = $inner;
    }

    /** @inheritDoc */
    public function getFeedQuery(Feed $feed, ?int $count = null, int $offset = 0): ?Query
    {
        $query = $this->inner->getFeedQuery($feed, $count, $offset);

        // If the feed is a stories-only feed, replace the query's condition
        if ($feed->get('mediaType') === StoryFeed::MEDIA_TYPE) {
            $query = new Query(
                $query->sources,
                $query->order,
                new Condition(Condition::OR, [
                    new Query\Expression(MediaPostType::PRODUCT_TYPE, '=', MediaProductType::STORY),
                    new Query\Expression(MediaPostType::IS_STORY, '=', '1'),
                ]),
                $query->count,
                $query->offset
            );
        }

        return $query;
    }

    /** @inheritDoc */
    public function getPreProcessors(Feed $feed, Query $query): array
    {
        return $this->inner->getPreProcessors($feed, $query);
    }

    /** @inheritDoc */
    public function getPostProcessors(Feed $feed, Query $query): array
    {
        return $this->inner->getPostProcessors($feed, $query);
    }

    /** @inheritDoc */
    public function doManualPagination(Feed $feed, Query $query): bool
    {
        return $this->inner->doManualPagination($feed, $query);
    }
}
