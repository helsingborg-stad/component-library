<?php

declare(strict_types=1);

use ComponentLibrary\Component\Loader\LoaderData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'loader',
    view: 'loader.blade.php',
    data: LoaderData::class,
    dependencies: [
        'sass' => [
            'components' => [
                'loader',
                'typography',
            ],
        ],
    ],
);
