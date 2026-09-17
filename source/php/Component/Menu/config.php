<?php

declare(strict_types=1);

use ComponentLibrary\Component\Menu\MenuData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'menu',
    view: 'menu.blade.php',
    data: MenuData::class,
    dependencies: ['sass' => ['components' => ['menu', 'icon']]],
);
