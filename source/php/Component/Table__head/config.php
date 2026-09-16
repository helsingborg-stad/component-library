<?php

declare(strict_types=1);

use ComponentLibrary\Component\Table__head\TableHeadData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'table__head',
    view: 'table__head.blade.php',
    data: TableHeadData::class,
    dependencies: [
        'sass' => [
            'components' => ['table'],
        ],
    ],
);
