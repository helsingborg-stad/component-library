<?php

return [
    'slug' => 'timeline',
    'default' => (object) [
        'events' => [],
        'sequential' => false,
    ],
    'description' => [
        'events' => 'An array of events',
        'sequential' => 'If true, the events will be displayed in a sequential order',
    ],
    'view' => 'timeline.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'card',
            ],
        ],
    ],
];
