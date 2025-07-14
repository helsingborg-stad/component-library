@group([
    'direction' => 'vertical',
    'classList' => ['c-person__contact', 'u-align-items--start', 'u-justify-content--start', 'u-margin__top--2']
])

    {{-- E-mail --}}
    @if ($email)
        <span data-tooltip="{!! $email !!}">
            @button([
                'text' => $lang->email,
                'color' => 'default',
                'style' => 'basic',
                'href' => 'mailto:' . $email,
                'icon' => 'mail',
                'reversePositions' => 'true',
                'attributeList' => [
                    'itemprop' => 'email',
                ],
                'classList' => ['c-button--email'],
            ])
            @endbutton
        </span>
    @endif

    {{-- Phone --}}
    @if (!empty($telephone))
        @foreach ($telephone as $phone)
            <span data-tooltip="{!! $phone['number'] !!}">
                @button([
                    'text' => $lang->call,
                    'color' => 'default',
                    'style' => 'basic',
                    'href' => 'tel:' . $phone['number'],
                    'icon' => $phone['type'] == 'smartphone' ? 'smartphone' : 'call',
                    'reversePositions' => 'true',
                    'attributeList' => [
                        'itemprop' => 'telephone',
                    ],
                    'classList' => [
                        'c-button--phone',
                        'c-button--' . $phone['type'],
                        'u-justify-content--start',
                        'u-margin__top--1'
                    ],
                ])
                @endbutton
            </span>
        @endforeach
    @endif

@endgroup