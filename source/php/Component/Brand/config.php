<?php

declare(strict_types=1);

use ComponentLibrary\Component\Brand\BrandData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'brand',
    view: 'brand.blade.php',
    data: BrandData::class,
    dependencies: [
        'sass' => [
            'components' => [
                'brand',
                'logotype',
                'image',
            ],
        ],
    ],
);
