@group([
    'direction' => 'vertical',
    'classList' => ['u-width--100']
])
    <div class="{{ $baseClass }}__text">
        <div class="o-grid">
            @if ($title)
                <div class="{{ $baseClass }}__title o-grid-12 o-grid-6@md">
                    @typography([
                        'element' => 'h1',
                        'variant' => 'h1'
                    ])
                        {{ $title }}
                    @endtypography
                </div>
            @endif

            @if ($paragraph || $buttons)
                <div class="{{ $baseClass }}__body o-grid-12 o-grid-6@md">
                    @if ($paragraph)
                        @typography()
                            {{ $paragraph }}
                        @endtypography
                    @endif

                    @if ($buttons)
                        <div class="{{ $baseClass }}__buttons">
                            @foreach ($buttons as $buttonArgs)
                                @button($buttonArgs)
                                @endbutton
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <div class="{{ $baseClass }}__media">
        <div class="{{ $baseClass }}__image">
            @image([
                'src' => $image,
                'cover' => true
            ])
            @endimage
        </div>

        @includeWhen($video || $hasAnimation, 'Hero.partials.controls')

        @if ($video)
            <div class="o-container {{ $baseClass }}__container">
                <video autoplay muted loop playsinline poster="{{ $poster }}" class="c-hero__video">
                    <source src="{{ $video }}" type="video/mp4">
                </video>
            </div>
        @endif
    </div>

@endgroup
