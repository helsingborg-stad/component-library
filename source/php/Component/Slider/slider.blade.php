<div class="{{ $class }}" {!! $attribute !!}>
    @includeWhen(!$customButtons, 'Slider.components.navigationButtons')

    <div class="{{ $baseClass }}__container splide__track">
        <div class="{{ $baseClass }}__inner splide__list" data-js-slider-inner>
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
</div>
