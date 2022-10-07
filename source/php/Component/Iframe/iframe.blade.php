<!-- iframe.blade.php -->
<div class="js-suppressed-iframe-wrapper"> 

    <div class="js-suppressed-iframe-prompt u-display--flex u-align-items--center u-overflow--auto">
        <div class="js-suppressed-iframe-prompt-content u-padding__x--3 u-width--100">
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

            @button([
                'text' => $labels->button,
                'color' => 'primary',
                'attributeList' => ['js-suppressed-iframe-button' => ''],
                'classList' => ['u-margin__y--3'],
            ])
            @endbutton
        </div>
    </div>
    <iframe 
        id="{{ $id }}" 
        class="{{ $class }}" 
        options="{{ $options }}"
        {!! $attribute !!}>
    </iframe>

</div>
