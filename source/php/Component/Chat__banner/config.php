<?php

declare(strict_types=1);

use ComponentLibrary\Component\Chat__banner\ChatBannerData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'chat__banner',
    view: 'chat__banner.blade.php',
    data: ChatBannerData::class,
    dependencies: ['sass' => ['components' => ['chat__banner', 'element']]],
);
