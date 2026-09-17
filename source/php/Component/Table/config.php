<?php

declare(strict_types=1);

use ComponentLibrary\Component\Table\TableData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'table',
    view: 'table.blade.php',
    data: TableData::class,
    dependencies: ['sass' => ['components' => ['table', 'icon', 'modal', 'field', 'card']]],
);
