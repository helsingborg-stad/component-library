<?php

declare(strict_types=1);

use ComponentLibrary\Component\Gallery\GalleryData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'gallery',
    view: 'gallery.blade.php',
    data: GalleryData::class,
    dependencies: ['sass' => ['components' => ['gallery', 'modal', 'image', 'button', 'icon']]],
);
