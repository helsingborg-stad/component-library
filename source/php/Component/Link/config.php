<?php

declare(strict_types=1);

use ComponentLibrary\Component\Link\LinkData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'link',
    view: 'link.blade.php',
    data: LinkData::class,
    dependencies: [
        'sass' => [
            'components' => [
                'link',
            ],
        ],
    ],
);
