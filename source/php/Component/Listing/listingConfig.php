<?php

return [
    'slug' => 'listing',
    'default' => (object) [
        'list' => [],
        'elementType' => 'ul',
        'icon' => true,
        'padding' => false,
    ],
    'description' => [
        'list' => 'List of arrays containing at least \'label\' but can also contain \'href\' and or \'icon\' according to the Icon component.',
        'elementType' => 'The type of list, ul, ol.',
        'icon' => 'Can be true/false or the name of the Icon. Displays an icon at the end of links',
        'padding' => 'False or a number between 0 and 10. Sets the padding between the child elements',
    ],
    'view' => 'listing.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'list',
                'icon',
            ],
        ],
    ],
];
