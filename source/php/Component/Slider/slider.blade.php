<div class="{{ $class }}" {!! $attribute !!}>
    @if($title || $preamble)
        <div class="{{ $baseClass }}__header">
            @if($title)
                @typography([
                    'element' => 'h2',
                    'variant' => 'h4',
                    'classList' => [$baseClass . '__title']
                ])
                    {{ $title }}
                @endtypography
            @endif
            @includeWhen(!$customButtons, 'Slider.components.navigationButtons')
            @if($preamble)
                @typography([
                    'element' => 'p',
                    'variant' => 'p',
                    'classList' => [$baseClass . '__preamble']
                ])
                    {{ $preamble }}
                @endtypography
            @endif
        </div>
    @else
        @includeWhen(!$customButtons, 'Slider.components.navigationButtons')
    @endif

    <div class="{{ $baseClass }}__container" id="{{ $id }}__track" data-js-slider-track tabindex="0" role="region" aria-roledescription="carousel">
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
