<?php

return [
    'slug' => 'avatar',
    'default' => (object) [
        'image' => false,
        'icon' => [],
        'name' => '',
        'size' => 'md',
    ],
    'description' => [
        'image' => 'A url to a profile image or an ImageInterface.',
        'icon' => 'Attributes for @icon component (separate reference).',
        'name' => 'Persons full name',
        'size' => 'sm,md,lg,full',
    ],
    'types' => [
        'image' => 'string|ImageInterface|boolean',
        'icon' => 'array',
        'name' => 'string',
        'size' => 'string',
    ],
    'view' => 'avatar.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'avatar',
                'icon',
            ],
        ],
    ],
];
