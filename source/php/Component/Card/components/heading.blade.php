@group([
    'justifyContent' => 'space-between',
    'alignItems' => 'center',
])
    @group([
        'direction' => 'vertical'
    ])

        @if($heading) 
            @typography([
                'element'   => 'h2',
                'variant'   => 'h3',
                'classList' => [
                    $baseClass."__heading",
                    'u-margin__y--0'
                ]
            ])
                {!! $heading !!}
            @endtypography
        @endif

        @if($subHeading)
            @typography([
                'element' => 'span', 
                'variant' => 'meta',
                'classList' => [
                    $baseClass . '__sub-heading',
                    'u-margin__y--0'
                ]
            ])
                {!! $subHeading !!}
            @endtypography
        @endif

        @includeWhen($meta && !$metaFirst, 'Card.components.meta')
    @endgroup
    @includeWhen($collapsible, 'Card.components.collapsiableButton')
    @includeWhen($icon && !empty($displayIcon), 'Card.components.icon')
@endgroup