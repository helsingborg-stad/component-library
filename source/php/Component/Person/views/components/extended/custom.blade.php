@foreach ($customSections as $section)
    @accordion__item([
        'heading' => [$section['title']]
    ])
        @typography([
            'element' => 'p',
            'variant' => 'meta',
            'classList' => ['u-margin__top--0', 'u-color__text--darker']
        ])
            {!! $section['content'] !!}
        @endtypography
    @endaccordion__item
@endforeach
