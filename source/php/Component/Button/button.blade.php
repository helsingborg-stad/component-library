<{{$componentElement}} class="{{ $class }}" {!! $attribute !!}>   
    @if(!$isLabel) <{{$labelElement}} class="{{$baseClass}}__label"> @endif
        @if ($type === 'submit' || $type === 'button')
            <span class="{{$baseClass}}__loader"></span>
        @endif

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
</{{$componentElement}}>