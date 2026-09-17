<?php

declare(strict_types=1);

use ComponentLibrary\Component\Nav\NavData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'nav',
    view: 'nav.blade.php',
    data: NavData::class,
    dependencies: ['sass' => ['components' => ['nav', 'icon', 'link']]],
);