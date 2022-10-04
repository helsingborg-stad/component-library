<!-- iframe.blade.php -->
<div class="js-suppressed-iframe-wrapper"> 
    <div class="js-suppressed-iframe-prompt" style="position:absolute; left:0; top:0; width:100%; height:100%; z-index:1; display: flex; align-items: center; overflow:auto;">
        <div style="max-width: 600px; width: 100%; margin: auto; padding: 0 24px;">
            @typography([
                'variant' => 'h3',
                'element' => 'h3',
            ])
            Titel text
            @endtypography
            @typography([

            ])
            Content text
            @endtypography

            @button([
                'text' => 'Knapp text',
                'color' => 'primary',
                'attributeList' => ['js-suppressed-iframe-button' => '']
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

<script>

</script>