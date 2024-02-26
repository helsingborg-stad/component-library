<div class="{{ $class }}" {!! $attribute !!}>
    @if($content)
        @typography([
        ])
            {{$content}}
        @endtypography
    @endif
    @if($footer)
        @typography([
        ])
            {{$footer}}
        @endtypography
    @endif
    @if($image)
        @image((array) $image)
        @endimage
    @endif
</div>