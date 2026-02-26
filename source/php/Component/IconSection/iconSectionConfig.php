<?php

return [
    'slug' => 'iconSection',
    'default' => (object) [
        'gap' => 0,
    ],
    'description' => [
        'gap' => 'The gap between the items in the icon section. Number between 0-12',
    ],
    'types' => [
        'gap' => 'number',
    ],
    'view' => 'iconSection.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'element',
            ],
        ],
    ],
];
