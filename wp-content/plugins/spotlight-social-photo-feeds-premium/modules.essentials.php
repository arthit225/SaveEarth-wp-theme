<?php

namespace RebelCode\Spotlight\Instagram\Modules\Essentials;

use RebelCode\Spotlight\Instagram\TierModule;

return [
    'essentials' => new TierModule(10),
    'essentials/engine' => new EssentialsEngineModule(),
    'essentials/ui' => new EssentialsUiModule(),
    'essentials/templates' => new EssentialsTemplatesModule(),
    'essentials/elementor' => new ElementorModule(),
];
