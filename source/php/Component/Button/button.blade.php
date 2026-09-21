<{{$componentElement}} class="{{ $class }}" {!! $attribute !!}>   
    @if($isCutoutFill)
        {{--
            The native control retains its aria-label. This hidden label is the
            visible renderer, preserving the standard font, flex, gap and icon
            layout. Both it and the SVG surface are presentational.
        --}}
        @if(!$isLabel) <{{$labelElement}} class="{{$baseClass}}__label {{$baseClass}}__cutout-label" aria-hidden="true"> @endif
            @if($icon)
                <span class="{{$baseClass}}__label-icon {{ $classListIcon }}">
                    @icon(['icon' => $icon, 'size' => $size, 'attributeList' => ['aria-hidden' => 'true']])
                    @endicon
                </span>
            @endif

            @if($text)
                <span class="{{$baseClass}}__label-text {{ $classListText }}">{{$text}}</span>
            @endif
        @if(!$isLabel) </{{$labelElement}}> @endif

        {{-- The SVG is visual only; the surrounding native control has the name. --}}
        <svg class="{{$baseClass}}__cutout" aria-hidden="true" focusable="false">
            <rect class="{{$baseClass}}__cutout-surface {{$baseClass}}__cutout-shape" x="0" y="0" width="100%" height="100%" />
        </svg>
    @else
        @if(!$isLabel) <{{$labelElement}} class="{{$baseClass}}__label"> @endif

            @if ($slotHasData)
                {!! $slot !!}
            @endif

            @if($icon)
                <span class="{{$baseClass}}__label-icon {{ $classListIcon }}">
                    @icon(['icon' => $icon, 'size' => $size, 'attributeList' => ['aria-hidden' => 'true']])
                    @endicon
                </span>
            @endif

            @if($text)
                <span class="{{$baseClass}}__label-text {{ $classListText }}">
                    {{$text}}
                </span>
            @endif

       @if(!$isLabel) </{{$labelElement}}> @endif
    @endif
</{{$componentElement}}>
