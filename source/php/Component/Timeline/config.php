<?php

declare(strict_types=1);

use ComponentLibrary\Component\Timeline\TimelineData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'timeline',
    view: 'timeline.blade.php',
    data: TimelineData::class,
    dependencies: ['sass' => ['components' => ['card']]],
);
