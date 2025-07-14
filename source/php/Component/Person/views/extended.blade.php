@card([
    'attributeList' => [
        'itemscope' => '',
        'itemtype' => 'http://schema.org/Person'
    ],
    'classList' => ['u-height--100', 'c-card--contact'],
    'context' => 'module.contacts.card'
])
    <div class="c-card__body u-padding--0">
        @signature([
            'author' => $fullName,
            'authorRole' => $fullTitle ?? '',
            'avatar' => $image ?? null,
            'placeholderAvatar' => $useAvatarFallback,
            'classList' => ['u-margin--2']
        ])
        @endsignature

        @if (!empty($description))
            @typography([
                'element' => 'div',
                'variant' => 'meta',
                'classList' => ['u-margin__x--2', 'u-margin__bottom--1', 'u-color__text--darker']
            ])
                {!! $description !!}
            @endtypography
        @endif

        @accordion([])
            {{-- Address --}}
            @includeWhen(!empty($address), 'Person.views.components.extended.address')

            {{-- Visiting Address --}}
            @includeWhen(!empty($visitingAddress), 'Person.views.components.extended.visiting')

            {{-- Other sections --}}
            @includeWhen(!empty($customSections), 'Person.views.components.extended.custom')
        @endaccordion
    </div>

    @if (array_filter([!empty($email), !empty($telephone), !empty($socialMedia)]))
        <div class="u-border__top--1 u-margin__top--auto u-padding__x--2"
            style="gap: var(--base, 8px); border-top-color: var(--color-border-divider) !important;">

            {{-- E-mail --}}
            @includeWhen(!empty($email), 'Person.views.components.extended.email', ['icon' => 'email'])

            {{-- Phone --}}
            @if (!empty($telephone))
                @foreach ($telephone as $phone)
                    @include('Person.views.components.extended.phone', $phone)
                @endforeach
            @endif

            {{-- Some --}}
            @if (!empty($socialMedia))
                @foreach ($socialMedia as $some)
                    @include('Person.views.components.extended.some', $some)
                @endforeach
            @endif

        </div>
    @endif
@endcard
