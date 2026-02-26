<?php

return [
    'slug' => 'toast__item',
    'default' => [],
    'description' => [],
    'types' => [],
    'view' => 'toast__item.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'notice',
                'toast',
            ],
        ],
    ],
];
