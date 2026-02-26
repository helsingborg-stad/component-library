<?php

return [
    'slug' => 'progressBar',
    'default' => (object) [
        'isCancelled' => false,
        'value' => 0,
    ],
    'description' => [],
    'view' => 'progressBar.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [],
        ],
    ],
];
