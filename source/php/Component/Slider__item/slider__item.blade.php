<!-- slider__item.blade.php -->
<section class="{{ $class }}" {!! $attribute !!}>
    
    {{-- Link --}}
    {!! $link ? '<a class="' . $baseClass . '__link" href="' . $link . '" ' . ($linkDescription ? 'aria-label="' . $linkDescription . '"' : '') . ' tabindex="0">' : '' !!}

    {{-- Assets --}}
    @includeWhen($video, 'Slider__item.sub.video')
    @includeWhen($image, 'Slider__item.sub.image')

    {{-- Content --}}
    @if ($slotHasData || $showContainer)
        <div class="{{ $baseClass }}__container">
           
            {{$slot}}

            @if($title)
                @typography([
                    "variant" => "h2",
                    "element" => "h2",
                    'classList' => [$baseClass.'__heading'],
                    'autopromote' => true,
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
                    ],
                    'context' => ['component.slider', 'component.slider.cta']
                ])
                @endbutton
            @endif
            
        </div>
    @endif

    {{ $link ? '</a>' : '' }} {{-- Close link --}}

</section>