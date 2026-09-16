<?php

declare(strict_types=1);

use ComponentLibrary\Component\Element\ElementData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'element',
    view: 'element.blade.php',
    data: ElementData::class,
    dependencies: [
        'sass' => [
            'components' => ['element'],
        ],
    ],
);
