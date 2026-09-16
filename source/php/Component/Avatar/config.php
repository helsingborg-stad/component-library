<?php

declare(strict_types=1);

use ComponentLibrary\Component\Avatar\AvatarData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'avatar',
    view: 'avatar.blade.php',
    data: AvatarData::class,
    dependencies: [
        'sass' => [
            'components' => [
                'avatar',
                'icon',
            ],
        ],
    ],
);
