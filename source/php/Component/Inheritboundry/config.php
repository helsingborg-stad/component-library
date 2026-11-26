<?php

declare(strict_types=1);

use ComponentLibrary\Component\Inheritboundry\InheritboundryData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'inheritboundry',
    view: 'inheritboundry.blade.php',
    data: InheritboundryData::class,
    dependencies: [
        'sass' => [
            'components' => ['inheritboundry'],
        ],
    ],
);
