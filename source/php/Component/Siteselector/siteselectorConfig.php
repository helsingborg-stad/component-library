<?php

return [
    'slug' => 'siteselector',
    'default' => (object) [
        'element' => 'div',
        'items' => [],
        'maxItems' => false,
        'showMoreLabel' => '',
        'radius' => 'full',
        'color' => 'primary',
    ],
    'description' => [
        'element' => 'What element the container will use.',
        'items' => 'Nav menu items',
        'maxItems' => 'The number of items to display before folding to a dropdown.',
        'showMoreLabel' => 'Te label of show more button.',
        'radius' => 'Amount of radius (xs, sm, md, lg, full)',
        'color' => 'Primary or secondary color.',
    ],
    'view' => 'siteselector.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'siteselector',
                'nav',
                'icon',
                'button',
            ],
        ],
    ],
];
