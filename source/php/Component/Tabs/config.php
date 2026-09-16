<?php

declare(strict_types=1);

use ComponentLibrary\Component\Tabs\TabsData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'tabs',
    view: 'tabs.blade.php',
    data: TabsData::class,
    dependencies: ['sass' => ['components' => ['tabs']]],
);
