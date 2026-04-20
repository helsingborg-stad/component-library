@button([
    'classList' => [
        $accordionClass . '__button',
        'u-padding__x--0',
    ],
    'attributeList' => [
        'role' => 'button',
        'aria-label' => $ariaLabel,
        'aria-controls' => $accordionClass . '__aria-' . $id,
        'aria-expanded' => 'false',
        'js-expand-button' => true,
        'style' => 'border-radius: unset;',
        'href' => '#'.$id
    ]
])
    @element([
        'element' => 'span',
        'classList' => [$accordionClass . '__button-wrapper', 'u-width--100', $headingType],
        'attributeList' => ['tabindex' => '-1']
        ])
        {!!$beforeHeading!!}

        @includeWhen($heading, 'Accordion__item.partials.heading')
        @if($taxonomyPosition === 'top' && $taxonomy > 0)
            @tags([
                'tags' => $taxonomy
            ])
            @endtags
        @endif

        {!!$afterHeading!!}

        @icon(['icon' => $icon, 'size' => 'md', 'classList' => [$accordionClass . '__icon', $accordionClass . '__icon--' . $icon]])
        @endicon
    @endelement
@endbutton
