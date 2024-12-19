<?php

namespace RebelCode\Spotlight\Instagram\Modules\Essentials;

use Dhii\Services\Factories\Constructor;
use Dhii\Services\Factory;
use Elementor\Plugin as ElementorPlugin;
use Psr\Container\ContainerInterface;
use RebelCode\Spotlight\Instagram\Di\ArrayMergeExtension;
use RebelCode\Spotlight\Instagram\Module;
use RebelCode\Spotlight\Instagram\Essentials\Elementor\ElementorSelectFeedControl;
use RebelCode\Spotlight\Instagram\Essentials\Elementor\ElementorWidget;
use RebelCode\Spotlight\Instagram\Utils\Arrays;
use RebelCode\Spotlight\Instagram\Wp\Asset;

/**
 * The module that adds integration with the Elementor page builder.
 *
 * @since 0.4
 */
class ElementorModule extends Module
{
    /**
     * @inheritDoc
     *
     * @since 0.4
     */
    public function run(ContainerInterface $c): void
    {
        if (!class_exists('Elementor\Plugin')) {
            return;
        }

        // Set the widget to render using the shortcode's callback
        add_action('elementor/init', function () use ($c) {
            ElementorWidget::setStaticProps(
                $c->get('shortcode/callback'),
                $c->get('ui/front_styles')
            );
        });

        // Register the main assets on the elementor editor page
        add_action('elementor/editor/before_enqueue_scripts', $c->get('ui/register_assets_fn'));

        // Register the widgets
        $version = $c->get('version');
        $registerHook = version_compare($version, '3.5.0', '<')
            ? 'elementor/widgets/widgets_registered'
            : 'elementor/widgets/register';

        add_action($registerHook, function () use ($c) {
            /* @var $plugin ElementorPlugin */
            /* @var $widget ElementorWidget */
            $plugin = $c->get('plugin');
            $widget = $c->get('widget');

            $plugin->widgets_manager->register($widget);
        });

        // Register the widget controls
        add_action('elementor/controls/controls_registered', function () use ($c) {
            /* @var $plugin ElementorPlugin */
            /* @var $control ElementorSelectFeedControl */
            $plugin = $c->get('plugin');
            $controls = $c->get('controls');

            Arrays::each($controls, function ($control) use ($plugin) {
                $plugin->controls_manager->register($control);
            });
        });
    }

    /**
     * @inheritDoc
     *
     * @since 0.4
     */
    public function getFactories(): array
    {
        return class_exists('Elementor\Plugin') ? [
            // The Elementor singleton instance
            'plugin' => new Factory([], function () {
                return ElementorPlugin::instance();
            }),
            'version' => new Factory([], function () {
                return defined('ELEMENTOR_VERSION') ? ELEMENTOR_VERSION : '';
            }),
            // The Spotlight Instagram widget for Elementor.
            // Do NOT add dependencies. Elementor widget constructor cannot be overridden.
            // See the static `setStaticProps` method on the widget class
            'widget' => new Constructor(ElementorWidget::class),
            // The controls to add to Elementor
            'controls' => new Factory([], function () {
                return [
                    new ElementorSelectFeedControl(),
                ];
            }),
            // App scripts added by this module
            'scripts' => new Factory(
                ['@ui/scripts_url', '@ui/assets_ver', '@ui/front_scripts'],
                function ($url, $ver, $frontScripts) {
                    return [
                        'sli-elementor-editor' => Asset::script("{$url}/elementor-editor.js", $ver, [
                            'sli-editor',
                        ]),
                        'sli-elementor-widget' => Asset::script("{$url}/elementor-widget.js", $ver, array_merge(
                            ['elementor-frontend'],
                            $frontScripts
                        )),
                    ];
                }
            ),
            // App styles added by this module
            'styles' => new Factory(['@ui/styles_url', '@ui/assets_ver'], function ($url, $ver) {
                return [
                    'sli-elementor-editor' => Asset::style("{$url}/elementor-editor.css", $ver, [
                        'wp-edit-post',
                        'sli-admin-common',
                        'sli-editor',
                        'sli-layouts-pro',
                    ]),
                ];
            }),
        ] : [];
    }

    /**
     * @inheritDoc
     *
     * @since 0.4
     */
    public function getExtensions(): array
    {
        return class_exists('Elementor\Plugin') ? [
            // Register the module's scripts
            'ui/scripts' => new ArrayMergeExtension('scripts'),
            // Register the module's styles
            'ui/styles' => new ArrayMergeExtension('styles'),
        ] : [];
    }
}
