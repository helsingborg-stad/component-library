@button([
    'classList' => [$baseClass . '__button'],
    'attributeList' => [
        'role' => 'tab',
        'aria-controls' => $baseClass . '__aria-' . $id . '-' . $loop->index,
        'aria-expanded' => $loop->index === 0 ? 'true' : 'false',
        'js-expand-button' => true,
        'style' => 'border-radius: unset;'
    ]
])
    @element([
        'componentElement' => 'span',
        'classList' => $baseClass . '__button-wrapper',
        'attributeList' => ['tabindex' => '-1']
    ])
        {{ $tab['title'] ?? '' }}
    @endelement
@endbutton