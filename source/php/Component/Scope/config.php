<?php

declare(strict_types=1);

use ComponentLibrary\Component\Scope\ScopeData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'scope',
    view: 'scope.blade.php',
    data: ScopeData::class,
    dependencies: [
        'sass' => [
            'components' => ['scope'],
        ],
    ],
);
