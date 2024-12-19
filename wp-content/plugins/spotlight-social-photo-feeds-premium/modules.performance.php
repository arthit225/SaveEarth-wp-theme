<?php

namespace RebelCode\Spotlight\Instagram\Modules\Performance;

use RebelCode\Spotlight\Instagram\TierModule;

return [
    'performance' => new TierModule(30),
    'performance/analytics' => new AnalyticsModule(),
];
