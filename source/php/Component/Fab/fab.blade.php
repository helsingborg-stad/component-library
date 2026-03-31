<div class="{{ $class }}" {!! $attribute !!}>

    @if($slotHasData)
        <div data-js-toggle-item="{{$panelId}}" data-js-toggle-class="{{$baseClass}}__panel--open" class="{{$baseClass}}__panel">

            @if($heading)
                @typography(["variant" => "h6", "classList" => [$baseClass . "__heading"]])
                    {{ $heading }}
                @endtypography
            @endif

            {!! $slot !!}

        </div>
    @endif

    @if ($button)
        @button($button)
        @endbutton
    @endif
</div>