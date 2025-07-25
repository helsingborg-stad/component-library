@accordion__item([
    'heading' => [$lang->visiting_address],
    'attributeList' => ['itemprop' => 'adress'],
])
    @typography([
        "element"       => "p",
        'variant'       => 'meta',
        'classList'     => [
            'u-margin__top--0',
            'u-color__text--darker'
        ]
    ])
        {!! $visitingAddress !!}
    @endtypography
@endaccordion__item