<?php

declare(strict_types=1);

use ComponentLibrary\Component\Card__floating\CardFloatingData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'card__floating',
    view: 'card__floating.blade.php',
    data: CardFloatingData::class,
    dependencies: [
        'sass' => [
            'components' => ['card'],
        ],
    ],
);
