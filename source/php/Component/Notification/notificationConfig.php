<?php

return [
    'slug' => 'notification',
    'default' => (object) [
        'element' => 'div',
        'slot' => '',
        'message' => [],
        'type' => null,
        'icon' => [],
        'animation' => (object) [
            'onPageLoad' => false,
            'direction' => null,
        ],
    ],
    'description' => [
        'element' => 'What element the markup will use.',
        'slot' => 'The content',
    ],
    'view' => 'notification.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'notification',
                'notice',
                'button',
                'icon',
            ],
        ],
    ],
];
