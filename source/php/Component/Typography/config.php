<?php

declare(strict_types=1);

use ComponentLibrary\Component\Typography\TypographyData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'typography',
    view: 'typography.blade.php',
    data: TypographyData::class,
    dependencies: ['sass' => ['components' => ['typography']]],
);
