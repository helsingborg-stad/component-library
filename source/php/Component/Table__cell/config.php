<?php

declare(strict_types=1);

use ComponentLibrary\Component\Table__cell\TableCellData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'table__cell',
    view: 'table__cell.blade.php',
    data: TableCellData::class,
    dependencies: [
        'sass' => [
            'components' => ['table'],
        ],
    ],
);
