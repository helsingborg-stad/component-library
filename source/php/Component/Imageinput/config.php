<?php

declare(strict_types=1);

use ComponentLibrary\Component\Imageinput\ImageinputData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'imageinput',
    view: 'imageinput.blade.php',
    data: ImageinputData::class,
    dependencies: ['sass' => ['components' => ['fileinput']]],
);
