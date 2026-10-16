<?php

declare(strict_types=1);

use ComponentLibrary\Component\Chat__info\ChatInfoData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'chat__info',
    view: 'chat__info.blade.php',
    data: ChatInfoData::class,
    dependencies: ['sass' => ['components' => ['chat__info', 'element']]],
);
