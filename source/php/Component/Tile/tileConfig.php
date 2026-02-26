<?php

return [
    'slug' => 'tile',
    'default' => (object) [
        'width' => '',
        'height' => '',
        'backgroundImage' => '',
    ],
    'description' => [
        'width' => 'Array with following keys: largeImage, smallImage, caption and alt',
        'height' => 'Array with following keys: largeImage, smallImage, caption and alt',
    ],
    'view' => 'tile.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'tile',
            ],
        ],
    ],
];
