<?php

use RebelCode\Spotlight\Instagram\Plugin;

$modules = require __DIR__ . '/modules.core.php';

if (sliFreemius()->is__premium_only()) {
    if (sliFreemius()->is_plan_or_trial('essentials')) {
        if (file_exists(__DIR__ . '/modules.essentials.php')) {
            $modules = array_merge($modules, require __DIR__ . '/modules.essentials.php');
        }
    }

    if (sliFreemius()->is_plan_or_trial('pro')) {
        if (file_exists(__DIR__ . '/modules.pro.php')) {
            $modules = array_merge($modules, require __DIR__ . '/modules.pro.php');
        }
    }

    if (sliFreemius()->is_plan_or_trial('performance')) {
        if (file_exists(__DIR__ . '/modules.performance.php')) {
            $modules = array_merge($modules, require __DIR__ . '/modules.performance.php');
        }
    }
}

// Filter the modules
$modules = apply_filters(Plugin::FILTER . '/modules', $modules);

return $modules;
