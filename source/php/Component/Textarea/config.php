<?php

declare(strict_types=1);

use ComponentLibrary\Component\Textarea\TextareaData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'textarea',
    view: 'textarea.blade.php',
    data: TextareaData::class,
    dependencies: ['sass' => ['components' => ['textarea', 'icon']]],
);
