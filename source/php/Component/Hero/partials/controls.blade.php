<div class="{{ $baseClass }}__controls" data-js-toggle-item="toggle-animation" js-video-control data-js-toggle-class="is-paused"> 
        @icon([
            'icon' => 'pause_circle',
            'size' => 'xl',
            'classList' => [$baseClass . '__animation-pause-button'],
            'attributeList' => [
                'data-js-toggle-trigger' => 'toggle-animation'
            ]
        ])
        @endicon

        @icon([
            'icon' => 'play_circle',
            'size' => 'xl',
            'classList' => [$baseClass . '__animation-play-button'],
            'attributeList' => [
                'data-js-toggle-trigger' => 'toggle-animation'
            ]
        ])
        @endicon
    </div>