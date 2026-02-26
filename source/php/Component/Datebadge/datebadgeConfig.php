<?php

return [
    'slug' => 'datebadge',
    'default' => (object) [
        'date' => false,
        'size' => 'md',
        'translucent' => false,
        'color' => 'light',
    ],
    'description' => [
        'date' => 'A date string in any format or a unix timestamp.',
        'size' => 'The size of the datebadge. Can be either \'sm\', \'md\' or \'lg\'.',
        'translucent' => 'If true, the datebadge will have a translucent background.',
        'color' => 'The color of the datebadge. Can be either \'light\', \'dark\', \'primary\', \'secondary\'.',
    ],
    'types' => [
        'date' => 'string|integer',
        'size' => 'string',
        'translucent' => 'boolean',
        'color' => 'string',
    ],
    'view' => 'datebadge.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'typography',
            ],
        ],
    ],
];
