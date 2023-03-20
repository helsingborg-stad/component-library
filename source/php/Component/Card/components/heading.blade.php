@group([
    'justifyContent' => 'space-between',
    'alignItems' => 'start',
])
    @group([
        'direction' => 'vertical'
    ])
        @typography([
            'element'   => 'h2',
            'variant'   => 'h3',
            'classList' => [
                $baseClass."__heading"
            ]
        ])
            {!! $heading !!}
        @endtypography

        @includeWhen($meta && !$metaFirst, 'Card.components.meta')
    @endgroup
    @includeWhen($icon, 'Card.components.icon')
@endgroup