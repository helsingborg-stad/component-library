<?php

declare(strict_types=1);

use ComponentLibrary\Component\Box\BoxData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'box',
    view: 'box.blade.php',
    data: BoxData::class,
    dependencies: [
        'sass' => [
            'components' => [
                'box',
                'image',
                'typography',
            ],
        ],
    ],
);
