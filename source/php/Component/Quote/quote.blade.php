<div class="{{ $class }}" {!! $attribute !!}>
    @image($image)
    @endimage
    @typography([])
        {{ $content }}
    @endtypography
    @typography([])
        {{ $footer }}
    @endtypography
</div>