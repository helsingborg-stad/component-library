<{{$componentElement}} class="{{ $class }}" target="{{ $target }}" {!! $attribute !!}>   
    @if(!$isLabel) <{{$labelElement}} class="{{$baseClass}}__label"> @endif
        @if ($loader)
            <span class="{{$baseClass}}__loader"></span>
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
</{{$componentElement}}>