<?php

return [
    'slug' => 'product',
    'default' => (object) [
        'heading' => '',
        'backgroundColor' => 'primary',
        'image' => false,
        'prices' => [],
        'currencyFirst' => false,
        'label' => '',
        'meta' => '',
        'bulletPoints' => [],
        'button' => [],
        'featured' => false,
    ],
    'description' => [
        'heading' => 'Product name',
        'backgroundColor' => 'Background color to use',
        'image' => 'An image object',
        'prices' => 'Array of price objects',
        'currencyFirst' => 'Should currency be displayed before the price',
        'label' => 'Label describing the product',
        'meta' => 'Extra text displayed above bullet points',
        'bulletPoints' => 'Array of bullet points for the product',
        'button' => 'The button to display at the bottom',
        'featured' => 'Is the product featured? Make the product stand out from the rest',
    ],
    'view' => 'field.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'card',
                'typography',
                'icon',
            ],
        ],
    ],
];
