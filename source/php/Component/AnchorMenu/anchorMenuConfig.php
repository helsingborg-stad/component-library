<?php

return [
    'slug' => 'anchorMenu',
    'default' => (object) [
        'menuItems' => [],
    ],
    'description' => [
        'menuItems' => 'An array containing arrays of items. An item should contain a label, anchor and if wanted an icon as well.',
    ],
    'types' => [
        'menuItems' => 'array',
    ],
    'view' => 'anchorMenu.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'link',
                'group',
                'icon',
            ],
        ],
    ],
];
