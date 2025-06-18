@group([
    'direction' => 'vertical',
    'classList' => ['c-person__details', 'u-margin__top--2']
])
    @typography([
        'element' => 'span',
        'classList' => ['c-person__name', 'u-bold'],
    ])
        {{ $fullName }}
    @endtypography

    @if ($fullTitle)
        @typography([
            'element' => 'span',
            'variant' => 'meta',
            'classList' => ['c-person__title']
        ])
            {{ $fullTitle }}
        @endtypography
    @endif

    @if ($address)
        @typography([
            'element' => 'span',
            'variant' => 'meta',
            'classList' => ['c-person__address']
        ])
            {!! $address !!}
        @endtypography
    @endif
@endgroup
