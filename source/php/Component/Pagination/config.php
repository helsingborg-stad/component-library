<?php

declare(strict_types=1);

use ComponentLibrary\Component\Pagination\PaginationData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'pagination',
    view: 'pagination.blade.php',
    data: PaginationData::class,
    dependencies: ['sass' => ['components' => ['pagination', 'button', 'icon']]],
);