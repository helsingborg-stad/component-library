<?php

return [
    'slug' => 'table',
    'default' => (object) [
        'list' => [],
        'headings' => [],
        'showHeader' => true,
        'showCaption' => false,
        'filterable' => false,
        'sortable' => false,
        'showSum' => false,
        'fullscreen' => false,
        'isMultidimensional' => false,
        'title' => '',
        'includePaper' => true,
        'labels' => (object) [
            'searchPlaceholder' => 'Search',
        ],
    ],
    'description' => [
        'list' => 'Array of items',
        'headings' => 'Array of items',
        'showHeader' => 'If header should be printed',
        'labels' => 'Label strings - replace for translation etc',
        'sortable' => 'Makes each th a button that sorts corresponding cells in column',
        'filterable' => 'Renders a field for real time filtering',
        'showSum' => 'Shows the sum of each column at the bottom of the table',
        'fullscreen' => 'Renders a button, that when clicked, makes the table fullscreen',
        'isMultidimensional' => 'Makes the first column a second dimension of headers and locks in it place when scrolling. Also allows the user to collapse the first column.',
        'title' => 'A title at above the table',
    ],
    'view' => 'table.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'table',
                'icon',
                'modal',
                'field',
                'card',
            ],
        ],
    ],
];
