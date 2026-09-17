<?php

declare(strict_types=1);

use ComponentLibrary\Component\Map\MapData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'map',
    view: 'map.blade.php',
    data: MapData::class,
    dependencies: ['sass' => ['components' => ['element']]],
);
