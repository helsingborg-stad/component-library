<section class="{{ $class }} c-hero--overflow" {!! $attribute !!}>
    <div class="{{$baseClass}}__image" style="{!! $imageStyleString !!}" data-js-toggle-item="toggle-animation" data-js-toggle-class="u-animation--pause">
    </div>
    @if ($overlay)
        <div class="{{ $baseClass }}__overlay"></div>
    @endif

    @includeWhen($video || $hasAnimation, 'Hero.partials.controls')

    @if ($title || $paragraph || $byline)
    {{-- {{ $baseClass }}__container --}}
        <div class="o-container">

            @group([
                'wrap' => 'wrap',
                'classList' => ['o-grid', 'u-flex-direction--row--reverse', $baseClass . '__content']
            ])
                <div class="{{$baseClass}}__content-group">
                    @image([
                        'src' => $imageSrc,
                        'classList' => ['u-margin__bottom--0', $baseClass . '__content-image']
                    ])
                    @endimage
                </div>
                @group([
                    'justifyContent' => 'center',
                    'direction' => 'vertical',
                    'classList' => [$baseClass . '__content-group']
                ])
                    @typography([
                        'variant' => 'h1',
                        'element' => 'h1',
                        'classList' => ['u-margin__top--1']
                    ])
                        {!! $title !!}
                    @endtypography

                    @typography([
                        'variant' => 'h2',
                        'element' => 'h2',
                        'classList' => ['u-margin__top--1']
                    ])
                        {!! $byline !!}
                    @endtypography

                    @typography([
                        'variant' => 'p',
                        'element' => 'p',
                        'classList' => ['u-margin__top--1']
                    ])
                        {!! $paragraph !!}
                    @endtypography
                @endgroup
            @endgroup
        </div>
    @endif
</section>