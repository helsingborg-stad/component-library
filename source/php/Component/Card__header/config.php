<?php

declare(strict_types=1);

use ComponentLibrary\Component\Card__header\CardHeaderData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'card__header',
    view: 'card__header.blade.php',
    data: CardHeaderData::class,
    dependencies: [
        'sass' => [
            'components' => ['card'],
        ],
    ],
);
