<?php

declare(strict_types=1);

use ComponentLibrary\Component\Toast\ToastData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'toast',
    view: 'notice.blade.php',
    data: ToastData::class,
    dependencies: ['sass' => ['components' => ['notice', 'Toast__item']]],
);
