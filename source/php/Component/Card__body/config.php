<?php

declare(strict_types=1);

use ComponentLibrary\Component\Card__body\CardBodyData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'card__body',
    view: 'card__body.blade.php',
    data: CardBodyData::class,
    dependencies: [
        'sass' => [
            'components' => ['card'],
        ],
    ],
);
