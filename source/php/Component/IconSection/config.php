<?php

declare(strict_types=1);

use ComponentLibrary\Component\IconSection\IconSectionData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'iconSection',
    view: 'iconSection.blade.php',
    data: IconSectionData::class,
    dependencies: [
        'sass' => [
            'components' => ['element'],
        ],
    ],
);
