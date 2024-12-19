<?php

namespace RebelCode\Spotlight\Instagram\Modules\Pro;

use Dhii\Services\Extension;
use Dhii\Services\Factories\Constructor;
use Dhii\Services\Factories\Value;
use Dhii\Services\Factory;
use Psr\Container\ContainerInterface;
use Psr\Http\Client\ClientInterface;
use RebelCode\Spotlight\Instagram\Config\WpOption;
use RebelCode\Spotlight\Instagram\Di\ArrayExtension;
use RebelCode\Spotlight\Instagram\Engine\Data\Source\HashtagSource;
use RebelCode\Spotlight\Instagram\Engine\Data\Source\TaggedUserSource;
use RebelCode\Spotlight\Instagram\Module;
use RebelCode\Spotlight\Instagram\Pro\Engine\Aggregator\CaptionHashtagFilterProcessor;
use RebelCode\Spotlight\Instagram\Pro\Engine\Aggregator\ModerationFilterProcessor;
use RebelCode\Spotlight\Instagram\Pro\Engine\Fetcher\HashtagPostsCatalog;
use RebelCode\Spotlight\Instagram\Pro\Engine\Fetcher\TaggedPostsCatalog;
use RebelCode\Spotlight\Instagram\Wp\PostType;

class ProEngineModule extends Module
{
    public function getFactories(): array
    {
        return [
            //==========================================================================================================
            // FETCHER
            //==========================================================================================================

            'fetcher/catalog/tagged' => new Factory(
                ['@ig/client', '@accounts/cpt'],
                function (ClientInterface $client, PostType $accounts) {
                    return new TaggedPostsCatalog($client, $accounts);
                }
            ),

            'fetcher/catalog/hashtag' => new Factory(
                ['@ig/client', '@accounts/cpt'],
                function (ClientInterface $client, PostType $accounts) {
                    return new HashtagPostsCatalog($client, $accounts);
                }
            ),

            //==========================================================================================================
            // AGGREGATOR
            //==========================================================================================================

            // The processor that filters media by the caption and hashtag filters
            'aggregator/processors/caption_hashtag_filter' => new Constructor(CaptionHashtagFilterProcessor::class, [
                '@config/set',
            ]),
            // The processor that filters moderated media
            'aggregator/processors/moderation_filter' => new Constructor(ModerationFilterProcessor::class),

            //==========================================================================
            // CONFIG
            //==========================================================================

            // The config entries for global filters
            'config/filters/hashtags/whitelist' => new Value(new WpOption('sli_hashtag_whitelist', [])),
            'config/filters/hashtags/blacklist' => new Value(new WpOption('sli_hashtag_blacklist', [])),
            'config/filters/captions/whitelist' => new Value(new WpOption('sli_caption_whitelist', [])),
            'config/filters/captions/blacklist' => new Value(new WpOption('sli_caption_blacklist', [])),
            // The config entries for global promotions
            'config/promotions/global' => new Value(new WpOption('sli_global_promotions', (object) [])),
            'config/promotions/auto' => new Value(new WpOption('sli_auto_promotions', [])),
        ];
    }

    public function getExtensions(): array
    {
        return [
            // Register the post-processors
            'engine/aggregator/pre_processors' => new ArrayExtension([
                'aggregator/processors/moderation_filter',
                'aggregator/processors/caption_hashtag_filter',
            ]),

            // Register the catalogs to the source->catalog map
            'engine/fetcher/strategy/catalog_map' => new Extension(
                ['fetcher/catalog/tagged', 'fetcher/catalog/hashtag'],
                function ($map, $tagged, $hashtag) {
                    $map[TaggedUserSource::TYPE] = $tagged;
                    $map[HashtagSource::TYPE_RECENT] = $hashtag;
                    $map[HashtagSource::TYPE_POPULAR] = $hashtag;

                    return $map;
                }
            ),

            // Register the config entries
            'config/entries' => new ArrayExtension([
                'hashtagWhitelist' => 'config/filters/hashtags/whitelist',
                'hashtagBlacklist' => 'config/filters/hashtags/blacklist',
                'captionWhitelist' => 'config/filters/captions/whitelist',
                'captionBlacklist' => 'config/filters/captions/blacklist',
                'promotions' => 'config/promotions/global',
                'autoPromotions' => 'config/promotions/auto',
            ]),
        ];
    }
}
