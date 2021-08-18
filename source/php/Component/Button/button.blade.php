<{{$componentElement}} id="{{ $id }}" class="{{ $class }}" href="{{$href}}" target="{{ $target }}" {!! $attribute !!}>   
    <{{$labelElement}} class="{{$baseClass}}__label">
    
        @if($text && $icon)
            <span class="{{$baseClass}}__label-text{{$labelMod}}">
                {{$text}}
            </span>

            <span class="{{$baseClass}}__label-icon{{$labelMod}}">
                @icon(['icon' => $icon, 'size' => $size])
                @endicon
            </span>
        @elseif($text && !$icon)
            <span class="{{$baseClass}}__label-text{{$labelMod}}">
                {{$text}}
            </span>
        @elseif($icon && !$text)
            @icon(['icon' => $icon, 'size' => $size])
            @endicon
        @endif

        @if ($slot)
            {{ $slot }}
        @endif
    
    </{{$labelElement}}>
</{{$componentElement}}>