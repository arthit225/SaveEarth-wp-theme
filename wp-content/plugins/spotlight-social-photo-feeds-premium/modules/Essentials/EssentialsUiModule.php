<?php

namespace RebelCode\Spotlight\Instagram\Modules\Essentials;

use Dhii\Services\Extension;
use Dhii\Services\Factories\Value;
use Dhii\Services\Factory;
use Psr\Container\ContainerInterface;
use RebelCode\Spotlight\Instagram\Di\ArrayMergeExtension;
use RebelCode\Spotlight\Instagram\Module;
use RebelCode\Spotlight\Instagram\Wp\Asset;

/**
 * The module that adds the UI assets for the Essentials tier to the core plugin.
 */
class EssentialsUiModule extends Module
{
    /** @inheritDoc */
    public function run(ContainerInterface $c): void
    {
    }

    /** @inheritDoc */
    public function getFactories(): array
    {
        return [
            'scripts' => new Factory(['@ui/scripts_url', '@ui/assets_ver'], function ($url, $ver) {
                return [
                    'sli-layouts-pro' => Asset::script("{$url}/layouts-pro.js", $ver, [
                        'sli-feed',
                    ]),
                ];
            }),
            'styles' => new Factory(['@ui/styles_url', '@ui/assets_ver'], function ($url, $ver) {
                return [
                    'sli-layouts-pro' => Asset::style("{$url}/layouts-pro.css", $ver, [
                        'sli-feed',
                    ]),
                ];
            }),

            // The additional scripts and styles to be enqueued for the admin app
            'admin_scripts' => new Value([
                'sli-layouts-pro',
            ]),
            'admin_styles' => new Value([
                'sli-layouts-pro',
            ]),

            // The additional scripts and styles to be enqueued for the front app
            'front_scripts' => new Value([
                'sli-layouts-pro',
            ]),
            'front_styles' => new Value([
                'sli-layouts-pro',
            ]),
        ];
    }

    /** @inheritDoc */
    public function getExtensions(): array
    {
        return [
            // Register the scripts and styles
            'ui/scripts' => new ArrayMergeExtension('scripts'),
            'ui/styles' => new ArrayMergeExtension('styles'),

            // Add the admin scripts and styles to be enqueued
            'ui/admin_scripts' => new ArrayMergeExtension('admin_scripts'),
            'ui/admin_styles' => new ArrayMergeExtension('admin_styles'),
            // Add the front scripts and styles to be enqueued
            'ui/front_scripts' => new ArrayMergeExtension('front_scripts'),
            'ui/front_styles' => new ArrayMergeExtension('front_styles'),

            // Add the scripts to the wp block
            'wp_block/script_deps' => new Extension(['scripts'], function ($prev, $scripts) {
                return array_merge($prev, array_keys($scripts));
            }),
            // Add the styles to the wp block
            'wp_block/style_deps' => new Extension(['styles'], function ($prev, $styles) {
                return array_merge($prev, array_keys($styles));
            }),
        ];
    }
}
