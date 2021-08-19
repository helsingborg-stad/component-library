<!-- segment.blade.php -->
<section id="{{ $id }}" class="{{ $class }}" {!! $attribute !!} js-slider-slide>
    @if ($link)
        <a class="{{ $baseClass }}__link" href="{{ $link }}">
    @endif

    @if ($background_video)
        @include('Slider__item.sub.video')
    @endif

    @if ($image)
        <img class="u-sr__only {{ $classListDesktop }}" src="{{ $image }}" alt="{{$alt}}"/>
    @endif

    @if ($slotHasData || $showContainer)
        <div class="{{ $baseClass }}__container">
            {{$slot}}

            @if($title)
                @typography([
                    "variant" => "h2",
                    "element" => "h2",
                    'classList' => [$baseClass.'__heading']
                ])
                    {{ $title }}
                @endtypography
            @endif

            @if(!empty($text))
                @typography([
                    'variant' => 'body',
                    'element' => 'p',
                    'classList' =>  [
                        $baseClass.'__body',
                        !($title) ? 'u-margin__top--0' : '',
                    ]
                ])
                    {!! $text !!}
                @endtypography
            @endif

            @if (isset($bottom))
                {{ $bottom }}
            @endif

            @if ($cta)
                @button([
                    'text'  => $cta['title'],
                    'href'  => $cta['href'],
                    'color' => 'default',
                    'style' => 'filled',
                    'icon'  => 'arrow_forward',
                    'classList' => [
                        $baseClass.'__cta'
                    ]
                ])
                @endbutton
            @endif
            
        </div>
    @endif

    @if ($link)
        </a>
    @endif
</section>