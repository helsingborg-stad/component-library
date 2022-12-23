{{-- change c-hero--overflow to modifier --}}
<section class="{{ $class }} c-hero--overflow c-hero--split-column" {!! $attribute !!}>
    <div class="{{$baseClass}}__image" style="{!! $imageStyleString !!}" data-js-toggle-item="toggle-animation" data-js-toggle-class="u-animation--pause">
    </div>

    @if ($title || $paragraph || $byline)
        <div class="o-container ">

            @group([
                'wrap' => 'wrap',
                'classList' => [$baseClass . '__content', 'o-grid', 'u-flex-direction--row--reverse']
            ])
                <div class="{{$baseClass}}__group">
                    @image([
                        'src' => $imageSrc,
                        'classList' => ['u-margin__bottom--0', $baseClass . '__group-image']
                    ])
                    @endimage
                </div>
                <div class="{{$baseClass}}__group">
                @group([
                    'justifyContent' => 'center',
                    'direction' => 'vertical',
                    'classList' => [$baseClass . '__group-content']
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
                </div>
            @endgroup
        </div>
    @endif
</section>