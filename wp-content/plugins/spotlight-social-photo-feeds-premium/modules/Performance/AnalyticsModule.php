<?php

namespace RebelCode\Spotlight\Instagram\Modules\Performance;

use Dhii\Services\Factories\Constructor;
use Dhii\Services\Factories\FuncService;
use Dhii\Services\Factories\ServiceList;
use Dhii\Services\Factories\Value;
use Dhii\Services\Factory;
use Psr\Container\ContainerInterface;
use RebelCode\Atlas\Atlas;
use RebelCode\Atlas\Schema;
use RebelCode\Atlas\Table;
use RebelCode\Spotlight\Instagram\Config\WpOption;
use RebelCode\Spotlight\Instagram\Di\ArrayExtension;
use RebelCode\Spotlight\Instagram\Di\ArrayMergeExtension;
use RebelCode\Spotlight\Instagram\Di\EndPointService;
use RebelCode\Spotlight\Instagram\Engine\DbOptionMarker;
use RebelCode\Spotlight\Instagram\Module;
use RebelCode\Spotlight\Instagram\Performance\Analytics\AnalyticsCollector;
use RebelCode\Spotlight\Instagram\Performance\Analytics\AnalyticsProcessor;
use RebelCode\Spotlight\Instagram\Performance\Analytics\AnalyticsTables;
use RebelCode\Spotlight\Instagram\Performance\Analytics\Cron\GatherAnalyticsCron;
use RebelCode\Spotlight\Instagram\Performance\Analytics\RestApi\AddPostClickEndPoint;
use RebelCode\Spotlight\Instagram\Performance\Analytics\RestApi\AddPromoClickEndPoint;
use RebelCode\Spotlight\Instagram\Performance\Analytics\RestApi\UpdateAnalyticsEndPoint;
use RebelCode\Spotlight\Instagram\Performance\Analytics\RestApi\GetAccountAnalyticsEndPoint;
use RebelCode\Spotlight\Instagram\Performance\Analytics\RestApi\GetAnalyticsCronInfoEndPoint;
use RebelCode\Spotlight\Instagram\Performance\Analytics\RestApi\GetEngagementAnalyticsEndPoint;
use RebelCode\Spotlight\Instagram\Performance\Analytics\RestApi\GetInsightsAnalyticsEndPoint;
use RebelCode\Spotlight\Instagram\Performance\Analytics\RestApi\GetInsightsGraphAnalyticsEndPoint;
use RebelCode\Spotlight\Instagram\Performance\Analytics\RestApi\GetPromotionAnalyticsEndPoint;
use RebelCode\Spotlight\Instagram\Performance\Analytics\RestApi\ManualAnalyticsEndPoint;
use RebelCode\Spotlight\Instagram\Wp\CronJob;
use wpdb;

class AnalyticsModule extends Module
{
    const CFG_IS_ENABLED = 'isAnalyticsEnabled';
    const CFG_DID_WELCOME = 'didAnalyticsWelcome';

    /** @inerhitDoc */
    public function run(ContainerInterface $c): void
    {
        // Register the handler for the cron job
        add_action($c->get('cron/hook'), $c->get('cron/handler'));

        /** @var CronJob $cronJob */
        $cronJob = $c->get('cron/job');

        if ($c->get('config/is_enabled')->getValue()) {
            // Make sure the DB tables exist if analytics are enabled
            $c->get('tables')->createTables();

            // If the cron is not scheduled, run it immediately
            if (!CronJob::isScheduled($cronJob)) {
                CronJob::schedule($cronJob);
            }
        } else {
            // Remove the cron if analytics are disabled
            CronJob::deschedule($cronJob);
        }

        add_action('spotlight/instagram/dev_page/tools', $c->get('dev_page/clear_analytics_renderer'));
        add_action('admin_init', $c->get('dev_page/clear_analytics_listener'));
    }

    /** @inerhitDoc */
    public function getFactories(): array
    {
        return [
            //==========================================================================================================
            // LOGIC
            //==========================================================================================================

            'collector' => new Constructor(AnalyticsCollector::class, [
                '@wp/db',
                'tables',
                '@ig/api/client',
                '@engine/instance',
                '@media/cpt',
                '@accounts/cpt',
                'cron/last_update_config',
            ]),

            'processor' => new Constructor(AnalyticsProcessor::class, [
                '@wp/db',
                'tables',
            ]),

            //==========================================================================================================
            // TABLES
            //==========================================================================================================

            'tables' => new Constructor(AnalyticsTables::class, [
                'markers/did_create_tables',
                'tables/accounts',
                'tables/posts',
                'tables/engagement',
                'tables/promotions',
            ]),

            // The prefix for each table name
            'table_prefix' => new Factory(['@wp/db'], function (wpdb $wpdb) {
                return $wpdb->prefix . 'sli_';
            }),

            // The marker that indicates whether the tables have been created yet
            'markers/did_create_tables' => new Factory([], function () {
                return new DbOptionMarker('sli_did_create_analytics_tables', true);
            }),

            'tables/accounts' => new Factory(
                ['table_prefix', '@atlas/instance'],
                function (string $prefix, Atlas $atlas) {
                    return $atlas->table($prefix . 'account_analytics', new Schema(
                        [   // Columns
                            'date' => new Schema\Column('DATE', null, false, false),
                            'account' => new Schema\Column('VARCHAR(100)', null, false, false),
                            'followers' => new Schema\Column('INT UNSIGNED', 0, true, false),
                            'likes' => new Schema\Column('INT UNSIGNED', 0, true, false),
                            'comments' => new Schema\Column('INT UNSIGNED', 0, true, false),
                        ],
                        [
                            // Keys
                            'sli_account_analytics_pk' => new Schema\PrimaryKey(['date', 'account']),
                        ]
                    ));
                }
            ),

            'tables/posts' => new Factory(
                ['table_prefix', '@atlas/instance'],
                function (string $prefix, Atlas $atlas) {
                    return $atlas->table($prefix . 'post_analytics', new Schema(
                        [   // Columns
                            'date' => new Schema\Column('DATE', null, false, false),
                            'account' => new Schema\Column('VARCHAR(100)', null, false, false),
                            'post' => new Schema\Column('VARCHAR(50)', null, false, false),
                            'type' => new Schema\Column('VARCHAR(20)', null, false, false),
                            'likes' => new Schema\Column('INT UNSIGNED', 0, true, false),
                            'comments' => new Schema\Column('INT UNSIGNED', 0, true, false),
                        ],
                        [
                            // Keys
                            'sli_post_analytics_pk' => new Schema\PrimaryKey(['date', 'account', 'post']),
                        ]
                    ));
                }
            ),

            'tables/engagement' => new Factory(
                ['table_prefix', '@atlas/instance'],
                function (string $prefix, Atlas $atlas) {
                    return $atlas->table($prefix . 'engagement', new Schema(
                        [   // Columns
                            'date' => new Schema\Column('DATE', null, false, false),
                            'account' => new Schema\Column('VARCHAR(200)', null, false, false),
                            'post' => new Schema\Column('VARCHAR(50)', null, false, false),
                            'type' => new Schema\Column('VARCHAR(20)', null, false, false),
                            'clicks' => new Schema\Column('INT UNSIGNED', 1, true, false),
                        ],
                        [
                            // Keys
                            'sli_engagement_pk' => new Schema\PrimaryKey(['date', 'post']),
                        ]
                    ));
                }
            ),

            'tables/promotions' => new Factory(
                ['table_prefix', '@atlas/instance'],
                function (string $prefix, Atlas $atlas) {
                    return $atlas->table($prefix . 'promo_analytics', new Schema(
                        [   // Columns
                            'date' => new Schema\Column('DATE', null, false, false),
                            'account' => new Schema\Column('VARCHAR(200)', null, false, false),
                            'post' => new Schema\Column('VARCHAR(50)', null, false, false),
                            'type' => new Schema\Column('VARCHAR(20)', null, false, false),
                            'source' => new Schema\Column('VARCHAR(20)', null, false, false),
                            'instance' => new Schema\Column('BIGINT(20) UNSIGNED', null, false, false),
                            'clicks' => new Schema\Column('INT UNSIGNED', 1, true, false),
                        ],
                        [
                            // Keys
                            'sli_promo_analytics_pk' => new Schema\PrimaryKey(['date', 'post', 'source']),
                        ]
                    ));
                }
            ),

            //==========================================================================================================
            // REST API
            //==========================================================================================================

            'api/endpoints' => new ServiceList([
                'api/endpoints/get_for_account',
                'api/endpoints/get_insights',
                'api/endpoints/get_engagement',
                'api/endpoints/get_promotions',
                'api/endpoints/get_insights_graph',
                'api/endpoints/add_post_click',
                'api/endpoints/add_promo_click',
                'api/endpoints/manual',
                'api/endpoints/fetch',
                'api/endpoints/get_cron_info',
            ]),

            'api/endpoints/get_for_account' => new EndPointService(
                '/analytics/account',
                ['GET'],
                GetAccountAnalyticsEndPoint::class,
                ['processor', '@accounts/cpt'],
                '@rest_api/auth/user'
            ),

            'api/endpoints/get_insights' => new EndPointService(
                '/analytics/insights',
                ['GET'],
                GetInsightsAnalyticsEndPoint::class,
                ['processor', '@server/instance', '@accounts/cpt'],
                '@rest_api/auth/user'
            ),

            'api/endpoints/get_engagement' => new EndPointService(
                '/analytics/engagement',
                ['GET'],
                GetEngagementAnalyticsEndPoint::class,
                ['processor', '@server/instance', '@feeds/manager'],
                '@rest_api/auth/user'
            ),

            'api/endpoints/get_promotions' => new EndPointService(
                '/analytics/promotions',
                ['GET'],
                GetPromotionAnalyticsEndPoint::class,
                ['processor', '@server/instance', '@feeds/manager'],
                '@rest_api/auth/user'
            ),

            'api/endpoints/get_insights_graph' => new EndPointService(
                '/analytics/insights/post',
                ['GET'],
                GetInsightsGraphAnalyticsEndPoint::class,
                ['processor'],
                '@rest_api/auth/user'
            ),

            'api/endpoints/add_post_click' => new EndPointService(
                '/analytics/click/post',
                ['POST'],
                AddPostClickEndPoint::class,
                ['collector'],
                '@rest_api/auth/public'
            ),

            'api/endpoints/add_promo_click' => new EndPointService(
                '/analytics/click/promo',
                ['POST'],
                AddPromoClickEndPoint::class,
                ['collector'],
                '@rest_api/auth/public'
            ),

            'api/endpoints/manual' => new EndPointService(
                '/analytics/manual',
                ['POST'],
                ManualAnalyticsEndPoint::class,
                ['@wp/db', 'tables'],
                '@rest_api/auth/user'
            ),

            'api/endpoints/fetch' => new EndPointService(
                '/analytics/update',
                ['POST'],
                UpdateAnalyticsEndPoint::class,
                ['collector'],
                '@rest_api/auth/user'
            ),

            'api/endpoints/get_cron_info' => new EndPointService(
                '/analytics/cron_info',
                ['GET'],
                GetAnalyticsCronInfoEndPoint::class,
                ['cron/job', 'cron/last_update_config', 'cron/is_running_marker'],
                '@rest_api/auth/user'
            ),

            //==========================================================================================================
            // CRON JOB
            //==========================================================================================================

            'cron/handler' => new Constructor(GatherAnalyticsCron::class, [
                'cron/job',
                'cron/time',
                'collector',
                'cron/is_running_marker',
            ]),

            'cron/hook' => new Value('spotlight/instagram/collect_analytics'),
            'cron/job' => new Constructor(CronJob::class, ['cron/hook']),
            'cron/time' => new Value('23:55'),

            // The config entry that records the last time analytics were updated
            'cron/last_update_config' => new Factory([], function () {
                return new WpOption('sli_analytics_last_fetch', 0, true, WpOption::SANITIZE_INT);
            }),
            // The marker that indicates whether the analytics cron is running
            'cron/is_running_marker' => new Factory([], function () {
                return new DbOptionMarker('sli_analytics_is_fetching');
            }),

            //==========================================================================================================
            // CONFIG
            //==========================================================================================================

            // The option that determines whether analytics are enabled
            'config/is_enabled' => new Factory([], function () {
                return new WpOption('sli_analytics_enabled', false, true, WpOption::SANITIZE_BOOL);
            }),

            // The option that determines whether the user has enabled analytics through the welcome modal
            'config/did_welcome' => new Factory([], function () {
                return new WpOption('sli_analytics_did_welcome', false, true, WpOption::SANITIZE_BOOL);
            }),

            //==========================================================================================================
            // FUNCTIONS
            //==========================================================================================================

            'functions/clear_all' => new FuncService(
                ['@wp/db', 'tables/accounts', 'tables/posts', 'tables/engagement', 'tables/promotions'],
                function (wpdb $wpdb, Table $accounts, Table $posts, Table $engagement, Table $promotions) {
                    $wpdb->query($accounts->delete());
                    $wpdb->query($posts->delete());
                    $wpdb->query($engagement->delete());
                    $wpdb->query($promotions->delete());
                }
            ),

            //==========================================================================================================
            // DEV TOOLS
            //==========================================================================================================

            'dev_page/clear_analytics_renderer' => new FuncService([], function () {
                ?>
                <h2>Clear Analytics</h2>
                <form method="POST">
                    <input type="hidden" name="sli_clear_analytics" value="<?= wp_create_nonce('sli_clear_analytics') ?>" />
                    <button type="submit" class="button">Delete all analytics data</button>
                </form>
                <?php
            }),

            'dev_page/clear_analytics_listener' => new FuncService(
                ['functions/clear_all'],
                function ($_, $clearAll) {
                    $nonce = filter_input(INPUT_POST, 'sli_clear_analytics');
                    if ($nonce) {
                        if (!wp_verify_nonce($nonce, 'sli_clear_analytics')) {
                            wp_die('You cannot do that!', 'Unauthorized', [
                                'back_link' => true,
                            ]);
                        }

                        $clearAll();

                        add_action('admin_notices', function () {
                            printf('<div class="notice notice-success"><p>%s</p></div>', 'Deleted all analytics data.');
                        });
                    }
                }
            ),
        ];
    }

    /** @inerhitDoc */
    public function getExtensions(): array
    {
        return [
            // Register the config entries
            'config/entries' => new ArrayExtension([
                self::CFG_IS_ENABLED => 'config/is_enabled',
                self::CFG_DID_WELCOME => 'config/did_welcome',
            ]),
            // Register the API endpoints
            'rest_api/endpoints' => new ArrayMergeExtension('api/endpoints'),
        ];
    }
}
