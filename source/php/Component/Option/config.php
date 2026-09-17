<?php

declare(strict_types=1);

use ComponentLibrary\Component\Option\OptionData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'option',
    view: 'option.blade.php',
    data: OptionData::class,
    dependencies: ['sass' => ['components' => ['option', 'icon']]],
);
