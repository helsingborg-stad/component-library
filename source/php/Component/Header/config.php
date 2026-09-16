<?php

declare(strict_types=1);

use ComponentLibrary\Component\Header\HeaderData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'header',
    view: 'header.blade.php',
    data: HeaderData::class,
    dependencies: ['sass' => ['components' => ['header']]],
);
