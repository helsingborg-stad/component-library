<?php

declare(strict_types=1);

use ComponentLibrary\Component\NewsItem\NewsItemData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'newsItem',
    view: 'newsItem.blade.php',
    data: NewsItemData::class,
    dependencies: ['sass' => ['components' => [
        'element',
        'image',
        'date',
        'group',
        'button',
        'icon',
        'grid',
        'typography',
    ]]],
);
