<?php

return [
    'slug' => 'logotypegrid',
    'default' => (object) [
        'items' => [],
    ],
    'description' => [
        'items' => 'A list of items, containing: src, alt, url(optional)',
    ],
    'view' => 'logotypegrid.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'logotypegrid',
                'logotype',
                'image',
            ],
        ],
    ],
];
