<!-- iframe.blade.php -->
<div class="js-suppressed-iframe-wrapper {{$isVideo}}"> 

    <div class="js-suppressed-iframe-prompt u-overflow--auto" style="{{$placeholderImage}}">
        @if($isVideo)<div class="js-suppressed-iframe-overlay u-height--100 u-width--100 u-position--absolute u-level-bottom"></div>@endif
        <div class="js-suppressed-iframe-prompt-content u-padding__x--3 u-width--100 u-level-1">
            @typography([
                'variant' => 'h3',
                'element' => 'h3',
            ])
           
            {{$labels->title}}
            @endtypography
            @typography([

            ])
             {!!$labels->info!!}
            @endtypography
            @if($isVideo)
            @icon([
                'icon' => 'play_circle', 
                'size' => 'xxl',
                'attributeList' => ['js-suppressed-iframe-button' => ''],
                'classList' => ['u-margin__y--3', 'u-align--middle'],
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
    <iframe 
        id="{{ $id }}" 
        class="{{ $class }}" 
        options="{{ $options }}"
        {!! $attribute !!}>
    </iframe>

</div>
