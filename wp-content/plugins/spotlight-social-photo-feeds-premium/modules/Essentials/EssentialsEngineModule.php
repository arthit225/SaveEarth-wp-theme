<?php

namespace RebelCode\Spotlight\Instagram\Modules\Essentials;

use Dhii\Services\Extension;
use Dhii\Services\Factories\Constructor;
use Dhii\Services\Factory;
use Psr\Http\Client\ClientInterface;
use RebelCode\Spotlight\Instagram\Di\ArrayExtension;
use RebelCode\Spotlight\Instagram\Di\OverrideExtension;
use RebelCode\Spotlight\Instagram\Essentials\Engine\StoriesAggregationStrategy;
use RebelCode\Spotlight\Instagram\Module;
use RebelCode\Spotlight\Instagram\Pro\Engine\Aggregator\MediaTypeFilterProcessor;
use RebelCode\Spotlight\Instagram\Pro\Engine\Fetcher\StoryPostsCatalog;
use RebelCode\Spotlight\Instagram\Wp\PostType;

class EssentialsEngineModule extends Module
{
    /** @inheritDoc */
    public function getFactories(): array
    {
        return [
            // The stories catalog
            'fetcher/catalog/stories' => new Factory(
                ['@ig/client', '@accounts/cpt'],
                function (ClientInterface $client, PostType $accounts) {
                    return new StoryPostsCatalog($client, $accounts);
                }
            ),

            // The processor that filters by media type
            'aggregator/processors/media_type_filter' => new Constructor(MediaTypeFilterProcessor::class),
        ];
    }

    /** @inheritDoc */
    public function getExtensions(): array
    {
        return [
            // Override the default story catalog
            'engine/fetcher/catalog/stories' => new OverrideExtension('fetcher/catalog/stories'),

            // Register the pre-processors
            'engine/aggregator/post_processors' => new ArrayExtension([
                'aggregator/processors/media_type_filter',
            ]),

            // Decorate the aggregation strategy to support stories
            'engine/aggregator/strategy' => new Extension([], function ($strategy) {
                return new StoriesAggregationStrategy($strategy);
            }),
        ];
    }
}
