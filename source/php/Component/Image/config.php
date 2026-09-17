<?php

declare(strict_types=1);

use ComponentLibrary\Component\Image\ImageData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'image',
    view: 'image.blade.php',
    data: ImageData::class,
    dependencies: ['sass' => ['components' => ['image', 'icon']]],
);
