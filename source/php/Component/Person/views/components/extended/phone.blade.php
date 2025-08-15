<span data-tooltip="{!! $number !!}">
    @button([
        'text' => $lang->call ?? 'Call',
        'color' => 'default',
        'style' => 'basic',
        'href' => 'tel:' . $number,
        'icon' => $icon ?? 'call',
        'reversePositions' => 'true',
        'attributeList' => [
            'itemprop' => 'telephone'
        ],
        'classList' => ['u-margin--0']
    ])
    @endbutton
</span>