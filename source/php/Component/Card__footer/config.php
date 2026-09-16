<?php

declare(strict_types=1);

use ComponentLibrary\Component\Card__footer\CardFooterData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'card__footer',
    view: 'card__footer.blade.php',
    data: CardFooterData::class,
    dependencies: [
        'sass' => [
            'components' => ['card'],
        ],
    ],
);
