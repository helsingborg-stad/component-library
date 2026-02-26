<?php

return [
    'slug' => 'iconSection__item',
    'default' => (object) [
        'icon' => null,
    ],
    'description' => [
        'icon' => 'An array with the same specification as the icon component',
    ],
    'types' => [
        'icon' => 'array',
    ],
    'view' => 'iconSection__item.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'element',
                'icon',
            ],
        ],
    ],
];
