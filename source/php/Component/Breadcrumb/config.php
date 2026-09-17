<?php

declare(strict_types=1);

use ComponentLibrary\Component\Breadcrumb\BreadcrumbData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'breadcrumb',
    view: 'breadcrumb.blade.php',
    data: BreadcrumbData::class,
    dependencies: ['sass' => ['components' => ['breadcrumb', 'icon']]],
);
