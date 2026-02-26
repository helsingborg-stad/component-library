<?php

return [
    'slug' => 'map',
    'default' => (object) [
        'markers' => [],
        'startPosition' => (object) [
            'lat' => 56.046467,
            'lng' => 12.694512,
            'zoom' => 16,
        ],
        'mapStyle' => 'default',
        'height' => '600px',
        'provider' => 'openstreetmap',
    ],
    'description' => [
        'startPosition' => 'An object containing lat, lng, and zoom.',
        'markers' => 'An array of objects containing lat, lng, and content.',
        'mapStyle' => 'Theming of the map (pale, dark, color, default)',
        'height' => 'A css height value including unit (px, vh, %)',
        'provider' => 'The map provider to use (openstreetmap, googlemaps)',
    ],
    'types' => [
        'startPosition' => 'object',
        'markers' => 'array',
        'mapStyle' => 'string',
        'height' => 'string',
        'fullWidth' => 'boolean',
        'provider' => 'string',
    ],
    'view' => 'map.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'element',
            ],
        ],
    ],
];
