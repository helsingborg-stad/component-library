<?php

declare(strict_types=1);

use ComponentLibrary\Component\Group\GroupData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'group',
    view: 'group.blade.php',
    data: GroupData::class,
    dependencies: [
        'sass' => [
            'components' => ['group'],
        ],
    ],
);
