@element([
    'classList' => [$baseClass . '__header']
])
    @button([
        'style' => 'basic',
        'icon' => 'close',
        'attributeList' => [
            'aria-controls' => $id,
            'popovertarget' => $id
        ],
        'classList' => [
            'c-drawer__close',
            'c-button--align-visually'
        ],
        'size' => 'md',
        'text' => $label,
    ])
    @endbutton

    @if($searchSlotHasData)
        {!! $search !!}
    @endif
@endelement
