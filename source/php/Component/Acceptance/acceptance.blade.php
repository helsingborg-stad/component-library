<!-- acceptance.blade.php -->
@if($requiresAccept)
<div class="{{ $class }}" {!! $attribute !!}>
    <div class="{{$baseClass}}__modal js-suppressed-content-prompt">
        <div class="{{$baseClass}}__modal-description js-suppressed-content-description">
            @if($supplierSystemType == 'video')
                @button([
                    'text' => !empty($infoLabel) ? $infoLabel : false,
                    'color' => 'default',
                    'style' => 'basic',
                    'icon' => $icon,
                    'attributeList' => [
                        'data-open' => 'modal-' . $uid
                    ],
                    'classList' => [
                        $baseClass . '__modal-info'
                    ],
                    ])
                @endbutton

                @button([
                    'icon'          => 'play_circle',
                    'style'         => 'basic',
                    'size'          => 'xxxl',
                    'attributeList' => ['js-suppressed-content-accept' => ''],
                    'classList'     => [$baseClass . '__modal-icon-play'],
                ])
                @endbutton

                @modal([
                    'id' => 'modal-' . $uid,
                    'heading' => $labels->title,
                    'overlay' => 'dark',
                ])
                    {!!$labels->info!!}
                @endmodal
            @else
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
                    @button([
                        'text' => $labels->button,
                        'color' => 'primary',
                        'attributeList' => ['js-suppressed-content-accept' => ''],
                        'classList' => ['u-margin__y--3'],
                    ])
                    @endbutton
                </div>
            @endif
        </div>
    </div>
	
    <!-- Display after accept -->
    <div class="{{$baseClass}}__content">
        <template>
            {!! $slot !!}
        </template>
    </div>
</div>
@else
{!! $slot !!} 
@endif
