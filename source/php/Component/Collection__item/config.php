<?php

declare(strict_types=1);

use ComponentLibrary\Component\Collection__item\CollectionItemData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'collection__item',
    view: 'collection__item.blade.php',
    data: CollectionItemData::class,
    dependencies: ['sass' => ['components' => ['collection', 'collection__item']]],
);
