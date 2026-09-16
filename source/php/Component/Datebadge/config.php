<?php

declare(strict_types=1);

use ComponentLibrary\Component\Datebadge\DatebadgeData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'datebadge',
    view: 'datebadge.blade.php',
    data: DatebadgeData::class,
    dependencies: [
        'sass' => [
            'components' => ['typography'],
        ],
    ],
);
