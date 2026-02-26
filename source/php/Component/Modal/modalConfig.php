<?php

return [
    'slug' => 'modal',
    'default' => (object) [
        'heading' => '',
        'slot' => '',
        'bottom' => '',
        'overlay' => 'light',
        'isPanel' => false,
        'id' => '',
        'animation' => 'slide-up',
        'navigation' => false,
        'size' => '',
        'padding' => 3,
        'borderRadius' => false,
        'transparent' => false,
        'closeButtonText' => '',
    ],
    'description' => [
        'heading' => 'The title of the modal',
        'slot' => 'The main content of the modal',
        'top' => 'Extra slot at the top of the modal (above title)',
        'bottom' => 'Extra slot at the bottom of the modal (below content)',
        'isPanel' => 'Removes padding, to enable a panel like behaviour. Cover whole page viewport.',
        'id' => 'A unique id which will be used to target the modal to open with the correct data-attr',
        'animation' => 'Available animations: slide-up, slide-down, slide-left, slide-right.',
        'navigation' => 'Adds navigation arrows, to slide between stuff.',
        'size' => 'Empty as default is set to max width 800px. But you can use sm, md and lg',
        'padding' => 'Adds whitespace around the content. Value: 1 - 4',
        'borderRadius' => 'Rounded edges. Value: sm, md, lg',
        'transparent' => 'Transparent wrapper around the content',
        'closeButtonText' => 'Text for the close button. Default is empty',
    ],
    'view' => 'modal.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'modal',
                'icon',
                'typography',
                'button',
                'stepper',
            ],
        ],
    ],
];
