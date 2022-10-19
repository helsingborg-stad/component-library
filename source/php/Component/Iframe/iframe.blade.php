<!-- iframe.blade.php -->
<div id="{{ $id }}" class="{{ $class }}" {!! $attribute !!}>
    <!-- Prompt accept -->
    <div class="{{$baseClass}}__modal js-suppressed-iframe-prompt">

            <div class="{{$baseClass}}__modal-description">
                @typography([
                    'variant' => 'h3',
                    'element' => 'h3',
                    'classList' => [$baseClass . '__modal-description-title'],
                ])
                    {{$labels->title}}
                @endtypography
                @typography([
                    'element' => 'p', 
                    'classList' => [$baseClass . '__modal-description-body']
                    ])
                    {!!$labels->info!!}
                @endtypography
                <div class="{{$baseClass}}__action">
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
        <iframe 
            id="{{ $id }}" 
            src="about:blank" 
            height="{{$height}}" 
            width="{{$width}}" 
            loading="{{$loading}}">
        </iframe>
    </div>
</div>
