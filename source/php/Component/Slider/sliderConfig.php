<?php

return [
    'slug' => 'slider',
    'default' => (object) [
        'showStepper' => true,
        'autoSlide' => true,
        'peekSlides' => false,
        'navigationHover' => true,
        'ratio' => '16:9',
        'repeatSlide' => true,
        'heroStyle' => false,
        'shadow' => true,
        'customButtons' => false,
        'arrowButtons' => (object) [
            'color' => 'primary',
            'style' => 'filled',
        ],
        'padding' => 0,
        'gap' => 2,
    ],
    'description' => [
        'showStepper' => 'Option to hide or show stepper.',
        'autoSlide' => 'If set to true, slider will auto slide with default delay. Can also receive an int to set delay in seconds',
        'peekSlides' => 'Adds some padding to show a peek of next and previous slides',
        'navigationHover' => 'Only show navigation when hovering over the slider',
        'ratio' => 'The size ratio of the slider',
        'repeatSlide' => 'Will allow the slide to repeat its cycle',
        'padding' => 'Sets the amount of padding between slides',
        'gap' => 'Sets the amount of gap between slides',
        'customButtons' => 'False will use default buttons, otherwise pass a string of the value of data-js-slider-buttons',
    ],
    'view' => 'slider.blade.php',
    'dependency' => [
        'sass' => [
            'components' => [
                'slider',
                'button',
                'icon',
                'steppers',
            ],
        ],
    ],
];
