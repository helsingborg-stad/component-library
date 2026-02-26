<?php

return [
    'slug' => 'group',
    'default' => (object) [
        'direction' => 'horizontal',
        'jusitifyContent' => '',
        'alignItems' => '',
        'alignContent' => '',
        'display' => '',
        'wrap' => '',
        'flexGrow' => false,
        'flexShrink' => true,
        'gap' => '',
        'fluidGrid' => null,
        'columns' => null,
    ],
    'description' => [
        'direction' => 'What direction to group (horizontal or vertical)',
        'jusitifyContent' => 'Justify the content to either position (ex. left, center, right)',
        'alignItems' => 'Alignment of the content items (ex. center)',
        'alignContent' => 'Alignment of the content (ex. end)',
        'flex' => 'Type of flex (ex. inline-flex)',
        'wrap' => 'Wrap the content (ex. nowrap, wrap, wrap-reverse)',
        'flexGrow' => 'Allow to grow the content within the group',
        'flexShrink' => 'Allow to shrink the content within the group',
        'gap' => 'A number between 1-10 that sets the gap between flexed elements.',
        'fluidGrid' => 'Uses flexbox and media queries to determine amount of items per row. Can be a number between 1-4 which will determine the maximum amount of items per row.',
        'columns' => 'Number of items per row. (number between 1-12)',
    ],
    'view' => 'group.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'group',
            ],
        ],
    ],
];
