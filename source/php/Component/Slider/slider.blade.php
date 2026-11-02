<div class="{{ $class }}" {!! $attribute !!}>
    @includeWhen(!$customButtons, 'Slider.components.navigationButtons')

    <div class="{{ $baseClass }}__container" id="slider_{{ $id }}__track" data-js-slider-track tabindex="0" role="region" aria-roledescription="carousel">
        <div class="{{ $baseClass }}__inner" data-js-slider-inner>
            {{ $slot }}
        </div>
    </div>
    
    @if($autoSlide)
        <div class="{{ $baseClass }}__controls">
            <button class="{{ $baseClass }}__autoslide-toggle" type="button">
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
            </button>
        </div>
    @endif
    <span class="u-sr__only" data-js-slider-status aria-live="polite" aria-atomic="true"></span>
</div>
