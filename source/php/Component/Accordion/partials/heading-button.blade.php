 @button([
    'classList' => [
        $baseClass . '__button',
        'u-padding__x--0',
    ],
    'attributeList' => [
        'role' => 'button',
        'aria-label' => $section['heading'],
        'aria-controls' => $baseClass . '__aria-' . $id . '-' . $loop->index,
        'aria-expanded' => 'false',
        'js-expand-button' => true,
        'style' => 'border-radius: unset;'
    ]
])
    @element([
        'element' => 'span',
        'classList' => [$baseClass . '__button-wrapper', 'u-width--100'],
        'attributeList' => ['tabindex' => '-1']
    ])
        {!!$beforeHeading!!}

        @typography([
            'element' => 'h3',
            'variant' => 'h6',
            'classList' => [$baseClass . '__button-column']
        ])
        {!! $section['heading'] !!}
        @endtypography
        @if($taxonomyPosition === 'top' && $taxonomy > 0)
            @tags([
                'tags' => $taxonomy
            ])
            @endtags
        @endif

        {!!$afterHeading!!}

        @icon(['icon' => 'keyboard_arrow_down', 'size' => 'md', 'classList' => [$baseClass . '__icon']])
        @endicon
    @endelement
@endbutton