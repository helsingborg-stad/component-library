<?php

declare(strict_types=1);

use ComponentLibrary\Component\Select\SelectData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'select',
    view: 'select.blade.php',
    data: SelectData::class,
    dependencies: ['sass' => ['components' => ['select', 'icon', 'filterSelect']]],
);
