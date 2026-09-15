<?php

declare(strict_types=1);

use ComponentLibrary\Component\Button\ButtonData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'button',
    view: 'button.blade.php',
    data: ButtonData::class,
    dependencies: [
        'sass' => [
            'components' => [
                'button',
                'icon',
            ],
        ],
    ],
);
