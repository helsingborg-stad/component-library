<?php

declare(strict_types=1);

use ComponentLibrary\Component\Card__image\CardImageData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'card__image',
    view: 'card__image.blade.php',
    data: CardImageData::class,
    dependencies: [
        'sass' => [
            'components' => ['card'],
        ],
    ],
);
