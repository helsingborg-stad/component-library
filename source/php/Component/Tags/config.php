<?php

declare(strict_types=1);

use ComponentLibrary\Component\Tags\TagsData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'tags',
    view: 'tags.blade.php',
    data: TagsData::class,
    dependencies: ['sass' => ['components' => ['tags', 'icon', 'link']]],
);
