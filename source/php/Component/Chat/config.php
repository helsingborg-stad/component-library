<?php

declare(strict_types=1);

use ComponentLibrary\Component\Chat\ChatData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'chat',
    view: 'chat.blade.php',
    data: ChatData::class,
    dependencies: ['sass' => ['components' => ['chat', 'chat__message', 'chat__input', 'element']]],
);
