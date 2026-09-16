<?php

declare(strict_types=1);

use ComponentLibrary\Component\Toast__item\ToastItemData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'toast__item',
    view: 'toast__item.blade.php',
    data: ToastItemData::class,
    dependencies: ['sass' => ['components' => ['notice', 'toast']]],
);
