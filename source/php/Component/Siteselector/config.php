<?php

declare(strict_types=1);

use ComponentLibrary\Component\Siteselector\SiteselectorData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'siteselector',
    view: 'siteselector.blade.php',
    data: SiteselectorData::class,
    dependencies: ['sass' => ['components' => ['siteselector', 'nav', 'icon', 'button', 'popover']]],
);
