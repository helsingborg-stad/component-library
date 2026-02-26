<?php

return [
    'slug' => 'collection__item',
    'default' => (object) [
        'componentElement' => 'div',
        'prefix' => '',
        'icon' => false,
        'iconLast' => false,
        'action' => false,
        'secondary' => '',
        'link' => '',
        'bordered' => false,
    ],
    'description' => [
        'elementType' => 'The type of list item. Default: li',
        'isCurrent' => 'Mark this as current',
        'isAligned' => 'Do not flow around elements placed either side of content.',
        'subItem' => 'Slot for providing subitems (automatically wrapped in new collection, with subcollection flag. )',
        'bordered' => 'Shows a border around the item.',
    ],
    'view' => 'collection__item.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'collection',
                'collection__item',
            ],
        ],
    ],
];
