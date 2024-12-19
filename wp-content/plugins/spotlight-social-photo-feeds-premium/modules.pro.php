<?php

namespace RebelCode\Spotlight\Instagram\Modules\Pro;

use RebelCode\Spotlight\Instagram\TierModule;

return [
    'pro' => new TierModule(20),
    'pro/engine' => new ProEngineModule(),
    'pro/ui' => new ProUiModule(),
];
