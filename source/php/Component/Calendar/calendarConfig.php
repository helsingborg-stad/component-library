<?php

return [
    'slug' => 'calendar',
    'default' => (object) [
        'componentElement' => 'div',
        'size' => 'large',
        'get' => '',
        'set' => '',
        'color' => 'default',
        'weekStart' => 'Monday',
    ],
    'description' => [],
    'view' => 'calendar.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'calendar',
                'modal',
                'button',
            ],
        ],
    ],
];
