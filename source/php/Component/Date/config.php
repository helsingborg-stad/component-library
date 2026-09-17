<?php

declare(strict_types=1);

use ComponentLibrary\Component\Date\DateData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'date',
    view: 'date.blade.php',
    data: DateData::class,
    dependencies: ['sass' => ['components' => ['date']]],
);
