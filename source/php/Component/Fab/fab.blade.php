<div class="{{ $class }}" {!! $attribute !!}>
    <div js-toggle-item="{{$panelId}}" js-toggle-class="{{$baseClass}}__panel--open" class="{{$baseClass}}__panel">

        @if($heading)
            @typography(["variant" => "h6", "classList" => [$baseClass . "__heading"]])
                {{ $heading }}
            @endtypography
        @endif

        {!! $slot !!}

    </div>

    @if ($button)
        @button($button)
        @endbutton
    @endif
</div>