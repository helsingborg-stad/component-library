<?php

declare(strict_types=1);

use ComponentLibrary\Component\Tile\TileData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'tile',
    view: 'tile.blade.php',
    data: TileData::class,
    dependencies: ['sass' => ['components' => ['tile']]],
);
