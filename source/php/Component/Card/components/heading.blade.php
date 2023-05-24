@group([
    'justifyContent' => 'space-between',
    'alignItems' => 'start',
])
    @group([
        'alignItems' => 'flex-end',
    ])
        @includeWhen(!$image || empty($image['src'] && ($dateBadge && $date)), 'Card.components.datebadge', ['datebadgeClasses' => ['u-margin__right--2']])
    @group([
        'display' => 'block'
    ])
        @typography([
            'element'   => 'h2',
            'variant'   => 'h3',
            'classList' => [
                $baseClass."__heading",
                'u-margin__top--0'
            ]
        ])
            {!! $heading !!}
        @endtypography
        @includeWhen($meta && !$metaFirst, 'Card.components.meta')
    @endgroup
    @endgroup
    @includeWhen($icon && !empty($displayIcon), 'Card.components.icon')
@endgroup