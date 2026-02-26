<?php

return [
    'slug' => 'dropdown',
    'default' => (object) [
        'items' => [],
        'href' => '#',
        'componentElement' => 'div',
        'itemElement' => 'a',
        'direction' => 'bottom',
        'popup' => '',
    ],
    'description' => [
        'href' => 'Where should the button link to?',
        'componentElement' => 'The tag to use for this component.',
        'items' => 'An array of arrays representing each item with a name and a link.',
        'direction' => 'The direction in which the popup-menu opens in.',
        'itemElement' => 'The tag to use for each list item.',
    ],
    'types' => [
        'items' => 'array',
        'href' => 'string',
        'componentElement' => 'string',
        'itemElement' => 'string',
        'direction' => 'string',
        'popup' => 'string',
    ],
    'view' => 'dropdown.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'dropdown',
            ],
        ],
    ],
];
