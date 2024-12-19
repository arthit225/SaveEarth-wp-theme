<?php

namespace RebelCode\Spotlight\Instagram\Modules;

use RebelCode\Spotlight\Instagram\Wp\Shortcode;
use RebelCode\Spotlight\Instagram\Wp\PostType;
use RebelCode\Spotlight\Instagram\Wp\NoticesManager;
use RebelCode\Spotlight\Instagram\Wp\Notice;
use RebelCode\Spotlight\Instagram\Wp\Menu;
use RebelCode\Spotlight\Instagram\Wp\CronJob;
use RebelCode\Spotlight\Instagram\Utils\Arrays;
use RebelCode\Spotlight\Instagram\PostTypes\AccountPostType;
use RebelCode\Spotlight\Instagram\Module;
use RebelCode\Spotlight\Instagram\Di\ArrayExtension;
use RebelCode\Spotlight\Instagram\Config\WpOption;
use RebelCode\Spotlight\Instagram\Config\ConfigSet;
use RebelCode\Spotlight\Instagram\Config\ConfigEntry;
use Psr\Container\ContainerInterface;
use Dhii\Services\Factory;
use Dhii\Services\Factories\Value;
use Dhii\Services\Factories\GlobalVar;

use Dhii\Services\Factories\FuncService;

/**
 * A module that contains services for various WordPress objects.
 *
 * @since 0.1
 */
class WordPressModule extends Module
{
    /**
     * @inheritDoc
     *
     * @since 0.1
     */
    public function getFactories() : array
    {
        return [
            'db' => new GlobalVar('wpdb'),
            'post_types' => new Value([]),
            'cron_jobs' => new Value([]),
            'shortcodes' => new Value([]),
            'widgets' => new Value([]),
            'menus' => new Value([]),
            'block_types' => new Value([]),
            // Notices
            'notices' => new Value([]),
            'notices/dismiss_nonce' => new Value('sli-dismiss-nonce'),
            'notices/dismiss_action' => new Value('sli-dismiss-notice'),
            'notices/manager' => new Factory(
                ['@ui/static_url', 'notices/dismiss_nonce', 'notices/dismiss_action', 'notices'],
                function (string $staticUrl, string $nonce, string $action, array $notices) {
                    return new NoticesManager($staticUrl . '/notices.js', $nonce, $action, $notices);
                }
            ),
            'notices/term_notice' => new Factory(['config/show_sli_term_notice'], function (ConfigEntry $option) {
                return new Notice('term_notice', Notice::WARNING, Notice::disableOption($option),
                    sprintf(
                        /* translators: %1$s Personal accounts doc link, %2$s Learn more about this change doc link */
                        __( '<b>Major API Update:</b> We\'ve detected that you\'re using <a href="%1$s" target="_blank">personal accounts</a> to display your Instagram feed. Instagram will soon no longer allow the use of personal accounts within Spotlight. <a href="%2$s" target="_blank">Learn more about this change</a> and what you need to do to prepare for it.', 'sli' ),
                        esc_url( 'https://docs.spotlightwp.com/article/551-connecting-an-instagram-personal-account' ),
                        esc_url( 'https://docs.spotlightwp.com/article/884-preparing-for-the-end-of-instagram-basic-display-api-what-to-expect-and-how-to-adapt' )
                    )
                );
            }),
            'notices' => new ArrayExtension([
                'notices/term_notice',
            ]),
            'config/show_sli_term_notice' => new Factory([], function () {
                return new WpOption('sli_show_term_notice', 0, true, WpOption::SANITIZE_BOOL);
            }),
            'migrations/*/check_personal_account' => new FuncService(['@accounts/cpt','@config/set'], function ($v1, $v2, PostType $accounts, ConfigSet $cfg) {
                $account = AccountPostType::findPersonalAccount($accounts);
                $cfg->get('personalAccountNotice')->setValue(!empty($account));
            }),
        ];
    }

    /**
     * @inheritDoc
     *
     * @since 0.1
     */
    public function run(ContainerInterface $c): void
    {
        // Register the cron jobs.
        // This hooks in the cron job handlers and takes care of scheduling and updating the cron job events.
        Arrays::each($c->get('cron_jobs'), [CronJob::class, 'register']);

        add_action('init', function () use ($c) {
            // Register the CPTs
            Arrays::each($c->get('post_types'), [PostType::class, 'register']);

            // Register the shortcodes
            Arrays::each($c->get('shortcodes'), [Shortcode::class, 'register']);

            // Register the block types
            Arrays::each($c->get('block_types'), 'register_block_type');
        });

        // Registers the menus for the WP Admin sidebar
        add_action('admin_menu', function () use ($c) {
            Arrays::each($c->get('menus'), [Menu::class, 'register']);
        });

        // Registers the widget
        add_action('widgets_init', function () use ($c) {
            Arrays::each($c->get('widgets'), 'register_widget');
        });

        // Register the notice dismissal AJAX handler
        $action = $c->get('notices/dismiss_action');
        add_action("wp_ajax_{$action}", function () use ($c) {
            /* @var NoticesManager $nm */
            $nm = $c->get('notices/manager');
            $nm->handleAjax();
            die;
        });

        $nm = $c->get('wp/notices/manager');
        $cfg = $c->get('config/set');
        if ($cfg->get('personalAccountNotice')->getValue()) {
            $nm->show('term_notice');
        }

    }

    public function getExtensions(): array
    {
        return [
            'config/entries' => new ArrayExtension([
                'personalAccountNotice' => 'config/show_sli_term_notice',
            ]),
            'migrator/migrations' => new ArrayExtension([
                'migrations/*/check_personal_account',
            ]),
        ];
    }
}
