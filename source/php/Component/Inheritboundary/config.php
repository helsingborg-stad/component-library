<?php

declare(strict_types=1);

use ComponentLibrary\Component\Inheritboundary\InheritboundaryData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'inheritboundary',
    view: 'inheritboundary.blade.php',
    data: InheritboundaryData::class,
    dependencies: [
        'sass' => [
            'components' => ['inheritboundary'],
        ],
    ],
);
