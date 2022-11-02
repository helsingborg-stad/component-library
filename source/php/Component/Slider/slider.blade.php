<div class="{{ $class }}" {!! $attribute !!}>

    @if($isPost === false)
        <div class="splide__arrows c-slider__arrows">
            @button([
                'color' => $arrowButtons['color'],
                'icon' => 'keyboard_arrow_left',
                'style' => $arrowButtons['style'],
                'classList' => ['splide__arrow', 'splide__arrow--prev']
            ])
            @endbutton
            @button([
                'color' => $arrowButtons['color'],
                'icon' => 'keyboard_arrow_right',
                'style' => $arrowButtons['style'],
                'classList' => ['splide__arrow', 'splide__arrow--next']
            ])
            @endbutton
        </div>
    
        <div class="{{ $baseClass }}__container splide__track">
            <div class="{{ $baseClass }}__inner splide__list" js-slider-inner>
                {{ $slot }}
            </div>
        </div>
    
        @if($autoSlide)
            <div class="{{ $baseClass }}__controls">
                <div class="{{ $baseClass }}__autoslide-toggle">
                    @icon([
                        'icon' => 'play_circle',
                        'size' => 'xl',
                        'classList' => [$baseClass . '__autoslide-play']
                    ])
                    @endicon
                    @icon([
                        'icon' => 'pause_circle',
                        'size' => 'xl',
                        'classList' => [$baseClass . '__autoslide-pause']
                    ])
                    @endicon
                </div>
            </div>
        @endif

        {{-- Slider when used in post module --}}
        @elseif($isPost)
            <div class=" u-display--none splide__arrows c-slider__arrows">
                @button([
                    'classList' => ['splide__arrow', 'splide__arrow--prev']
                ])
                @endbutton
                @button([
                    'classList' => ['splide__arrow', 'splide__arrow--next']
                ])
                @endbutton
            </div>
        
            <div class="{{ $baseClass }}__container splide__track">
                <div class="{{ $baseClass }}__inner splide__list" js-slider-inner>
                    {{ $slot }}
                </div>
            </div>

            @if($autoSlide)
                <div class="{{ $baseClass }}__controls">
                    <div class="{{ $baseClass }}__autoslide-toggle">
                        @icon([
                            'icon' => 'play_circle',
                            'size' => 'xl',
                            'classList' => [$baseClass . '__autoslide-play']
                        ])
                        @endicon
                        @icon([
                            'icon' => 'pause_circle',
                            'size' => 'xl',
                            'classList' => [$baseClass . '__autoslide-pause']
                        ])
                        @endicon
                    </div>
                </div>
            @endif
        @endif
</div>
