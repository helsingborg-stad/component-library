<?php

declare(strict_types=1);

use ComponentLibrary\Component\Card\CardData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'card',
    view: 'card.blade.php',
    data: CardData::class,
    dependencies: ['sass' => ['components' => ['card', 'paper', 'icon', 'accordion', 'image', 'typography', 'avatar', 'group']]],
);