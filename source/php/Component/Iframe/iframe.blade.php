<!-- iframe.blade.php -->
<div class="js-suppressed-iframe-wrapper {{$isVideo}}"> 
    <div class="js-suppressed-iframe-prompt u-overflow--auto u-padding__top--3">
        <div class="js-suppressed-iframe-prompt-content u-padding__x--3 u-width--100 u-level-1">
            @typography([
                'variant' => 'h3',
                'element' => 'h3',
            ])
                {{$labels->title}}
            @endtypography
            @typography(['element' => 'p'])
                {!!$labels->info!!}
            @endtypography

            @if($isVideo)
                <div class="suppressed-iframe-icon-button u-margin__y--3">
                    @icon([
                        'icon' => 'play_circle', 
                        'size' => 'xxl',
                        'attributeList' => ['js-suppressed-iframe-button' => ''],

                    ])
                    @endicon
                </div>
            @else 
                @button([
                    'text' => $labels->button,
                    'color' => 'primary',
                    'attributeList' => ['js-suppressed-iframe-button' => ''],
                    'classList' => ['u-margin__y--3'],
                ])
                @endbutton
            @endif
        </div>
    </div>
    <iframe 
        id="{{ $id }}" 
        class="{{ $class }}" 
        options="{{ $options }}"
        {!! $attribute !!}>
    </iframe>
</div>
