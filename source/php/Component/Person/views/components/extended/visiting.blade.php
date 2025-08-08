@accordion__item([
    'heading' => [$lang->visitingAddress ?? 'Visiting address'],
    'attributeList' => ['itemprop' => 'address'],
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