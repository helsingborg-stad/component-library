<?php

declare(strict_types=1);

use ComponentLibrary\Component\Table__row\TableRowData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'table__row',
    view: 'table__row.blade.php',
    data: TableRowData::class,
    dependencies: [
        'sass' => [
            'components' => ['table'],
        ],
    ],
);
