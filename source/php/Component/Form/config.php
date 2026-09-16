<?php

declare(strict_types=1);

use ComponentLibrary\Component\Form\FormData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'form',
    view: 'form.blade.php',
    data: FormData::class,
    dependencies: ['sass' => ['components' => ['form', 'notice']]],
);
