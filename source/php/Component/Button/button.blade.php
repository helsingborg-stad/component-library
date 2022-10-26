<{{$componentElement}} class="{{ $class }}" target="{{ $target }}" {!! $attribute !!}>   
    <{{$labelElement}} class="{{$baseClass}}__label">
        
        @if($icon)
            <span class="{{$baseClass}}__label-icon {{ $classListIcon }}">
                @icon(['icon' => $icon, 'size' => $size])
                @endicon
            </span>
        @endif

        @if($text)
            <span class="{{$baseClass}}__label-text {{ $classListText }}">
                {{$text}}
            </span>
        @endif

    </{{$labelElement}}>
</{{$componentElement}}>