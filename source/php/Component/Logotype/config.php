<?php

declare(strict_types=1);

use ComponentLibrary\Component\Logotype\LogotypeData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'logotype',
    view: 'logotype.blade.php',
    data: LogotypeData::class,
    dependencies: ['sass' => ['components' => ['logotype', 'image']]],
);
