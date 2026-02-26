<?php

return [
    'slug' => 'inlineCssWrapper',
    'default' => (object) [
        'componentElement' => 'div',
        'styles' => [],
    ],
    'description' => [],
    'types' => [
        'componentElement' => 'string',
        'styles' => 'array',
    ],
    'view' => 'inlineCssWrapper.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'inlineCssWrapper',
            ],
        ],
    ],
];
