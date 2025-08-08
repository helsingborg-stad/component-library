@accordion__item([
    'heading' => [$lang->address ?? 'Address'],
    'attributeList' => ['itemprop' => 'address'],
])
    @typography([
        "element"       => "p",
        'variant'       => 'meta',
        'classList'     => [
            'u-margin__top--0',
            'u-color__text--darker'
        ],
        'attributeList' => [
            'translate' => 'no'
        ]
    ])
    {!! $address !!}
    @endtypography
@endaccordion__item