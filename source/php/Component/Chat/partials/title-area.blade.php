@element([
    'classList' => [
        $baseClass . '__title-area',
    ]
])
    @if($title)
        @typography([
            'element' => 'h2',
            'variant' => 'h6',
        ])
            Chat
        @endtypography
    @endif

    @if($titleSlotHasContent)
        {!! $titleArea !!}
    @endif
@endelement