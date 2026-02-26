<?php

return [
    'slug' => 'header',
    'default' => (object) [
        'componentElement' => 'header',
        'id' => null,
        'textColor' => false,
        'backgroundColor' => false,
        'sticky' => false,
    ],
    'descriptions' => [
        'componentElement' => 'The element tag to render',
        'logotypeHref' => 'The url to link the logotype to.',
        'id' => 'Custom container id',
        'textColor' => 'Color name of the text',
        'backgroundColor' => 'Color name of the background',
        'sticky' => 'Stick to top when scrolling',
    ],
    'view' => 'header.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'header',
            ],
        ],
    ],
];
