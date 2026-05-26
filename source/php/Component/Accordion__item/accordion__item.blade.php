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
            @element([
                'componentElement' => 'span',
                'classList' => [$baseClass . '__heading-item']
            ])
                {{ $headingItem }}
            @endelement
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