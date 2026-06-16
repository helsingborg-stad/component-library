{{-- Accordion Item --}}
@element([
    'componentElement' => 'details',
    'classList' => $classList ?? [],
    'attributeList' => $attributeList ?? []
])
    @element([
        'componentElement' => 'summary',
        'classList' => [$baseClass . '__heading']
    ])
        @foreach($heading as $headingItem)
            @typography([
                'element' => 'h3',
                'variant' => 'h4',
                'classList' => [$baseClass . '__heading-item'],
            ])
                {{ $headingItem }}
            @endtypography
        @endforeach

        @icon([
            'icon' => 'keyboard_arrow_down',
            'size' => 'md',
            'classList' => [$baseClass . '__icon']
        ])
        @endicon
    @endelement
    @element([
        'componentElement' => 'div',
        'classList' => [$baseClass . '__content']
    ])
        {{ $content }}
        {{ $slot }}
    @endelement
@endelement
