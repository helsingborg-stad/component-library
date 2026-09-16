<?php

declare(strict_types=1);

use ComponentLibrary\Component\Table__body\TableBodyData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'table__body',
    view: 'table__body.blade.php',
    data: TableBodyData::class,
    dependencies: [
        'sass' => [
            'components' => ['table'],
        ],
    ],
);
