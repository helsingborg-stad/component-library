<?php

declare(strict_types=1);

use ComponentLibrary\Component\Icon\IconData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'icon',
    view: 'icon.blade.php',
    data: IconData::class,
    dependencies: ['sass' => ['components' => ['icon']]],
);