<?php

declare(strict_types=1);

use ComponentLibrary\Component\Slider__item\Slider__itemData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'slider__item',
    view: 'slider__item.blade.php',
    data: Slider__itemData::class,
    dependencies: ['sass' => ['components' => ['slider__item', 'typography', 'button', 'video']]],
);