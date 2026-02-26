<?php

return [
    'slug' => 'steppers',
    'default' => (object) [
        'slot' => '',
        'type' => 'dots',
    ],
    'description' => [
        'slot' => 'Steppers slot',
        'type' => 'Type of stepper, default is dots',
    ],
    'view' => 'steppers.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'steppers',
            ],
        ],
    ],
];
