<?php

declare(strict_types=1);

use ComponentLibrary\Component\Product\ProductData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'product',
    view: 'field.blade.php',
    data: ProductData::class,
    dependencies: ['sass' => ['components' => ['card', 'typography', 'icon']]],
);
