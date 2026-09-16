<?php

declare(strict_types=1);

use ComponentLibrary\Component\IconSection__item\IconSectionItemData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'iconSection__item',
    view: 'iconSection__item.blade.php',
    data: IconSectionItemData::class,
    dependencies: [
        'sass' => [
            'components' => [
                'element',
                'icon',
            ],
        ],
    ],
);
