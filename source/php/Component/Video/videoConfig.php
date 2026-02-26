<?php

return [
    'slug' => 'video',
    'default' => (object) [
        'hasControls' => true,
        'isMuted' => false,
        'shouldAutoplay' => false,
        'errorMessage' => 'This component is not supported by your browser.',
        'formats' => [],
        'height' => 300,
        'width' => 600,
        'subtitles' => false,
    ],
    'description' => [
        'hasControls' => 'Adds UI controls for play and pause',
        'isMuted' => 'If there should be audio enabled',
        'shouldAutoplay' => 'If the video should start automatically (requires isMuted)',
        'errorMessage' => 'A message to display when video is not supported.',
        'formats' => 'Array of formats',
        'height' => 'Initial height of video',
        'width' => 'Initial width of video',
        'subtitles' => 'Array of subtitles for video',
    ],
    'view' => 'video.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'video',
                'notice',
                'button',
                'icon',
            ],
        ],
    ],
];
