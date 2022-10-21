<!-- acceptance.blade.php -->
<div id="{{ $id }}" class="{{ $class }} js-suppressed-iframe" {!! $attribute !!}>
        <div class="{{$baseClass}}__modal js-suppressed-iframe-prompt">
            <div class="{{$baseClass}}__modal-description js-suppressed-iframe-description" style="display: none;">
                @typography([
                    'variant' => 'h3',
                    'element' => 'h3',
                    'classList' => [$baseClass . '__modal-title'],
                ])
                    {{$labels->title}}
                @endtypography
                @typography([
                    'element' => 'p', 
                    'classList' => [$baseClass . '__modal-body']
                    ])
                    {!!$labels->info!!}
                @endtypography
                <div class="{{$baseClass}}__modal-button">
                    @if($isVideo)
                        @icon([
                            'icon' => 'play_circle', 
                            'size' => 'xxl',
                            'attributeList' => ['js-suppressed-iframe-button' => ''],
    
                        ])
                        @endicon
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
</div>
    <!-- Display after accept -->
    <div class="{{$baseClass}}__content">
        <template>
            {!! $slot !!}
        </template>
    </div>
</div>
