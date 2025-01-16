@element([
    'attributeList' => [
        'style' => 'background-color: ' . ($iconBackgroundColor ?? 'transparent') . ';',
    ],
    'classList' => [
        'u-display--flex',
        $iconBackgroundColor ? 'u-padding__x--1' : '',
        $iconBackgroundColor ? 'u-padding__y--1' : '',
        'u-rounded--full',
        'u-detail-shadow-3'
    ]
])
    @icon($icon)
    @endicon
@endelement