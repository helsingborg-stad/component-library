@if($href)
    <a class="{{ $class }}" target="{{ $target }}" href="{{ $href }}" {!! $attribute !!}>
        {!! $slot !!}
    </a>
@elseif(!$href && $keepContent)
    <{{$componentElement}} class="{{ $class }}" {!! $attribute !!}>    
        {!! $slot !!}
    </{{$componentElement}}>
@endif