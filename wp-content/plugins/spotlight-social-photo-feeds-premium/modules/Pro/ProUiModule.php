<?php

namespace RebelCode\Spotlight\Instagram\Modules\Pro;

use Dhii\Services\Extension;
use Dhii\Services\Factories\Value;
use Dhii\Services\Factory;
use Psr\Container\ContainerInterface;
use RebelCode\Spotlight\Instagram\Config\ConfigEntry;
use RebelCode\Spotlight\Instagram\Di\ArrayMergeExtension;
use RebelCode\Spotlight\Instagram\Module;
use RebelCode\Spotlight\Instagram\Wp\Asset;

/**
 * The module that adds the PRO ui assets to the core plugin.
 */
class ProUiModule extends Module
{
    /** @inheritDoc */
    public function getFactories(): array
    {
        return [
            'scripts' => new Factory(['@ui/scripts_url', '@ui/assets_ver'], function ($url, $ver) {
                return [
                    'sli-admin-pro' => Asset::script("{$url}/admin-pro.js", $ver, [
                        'sli-admin',
                        'sli-layouts-pro',
                    ]),
                ];
            }),

            // The additional scripts and styles to be enqueued for the admin app
            'admin_scripts' => new Value([
                'sli-admin-pro',
            ]),
        ];
    }

    /** @inheritDoc */
    public function getExtensions(): array
    {
        return [
            // Register the scripts
            'ui/scripts' => new ArrayMergeExtension('scripts'),

            // Add the admin scripts and styles to be enqueued
            'ui/admin_scripts' => new ArrayMergeExtension('admin_scripts'),

            // Extend the UI common l10n data with the global and auto promotions
            'ui/l10n/common' => new Extension(
                ['@pro/engine/config/promotions/auto', '@pro/engine/config/promotions/global'],
                function ($config, ConfigEntry $autoPromos, ConfigEntry $globalPromos) {
                    $config['promos'] = [
                        'global' => $globalPromos->getValue(),
                        'autos' => $autoPromos->getValue(),
                    ];

                    return $config;
                }
            ),
        ];
    }
}
