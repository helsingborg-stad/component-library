@if ($href)
    <a class="{{ $class }}" {!! $attribute !!}>
        {!! $slot !!}
    </a>
@elseif(!$href && $keepContent && $keepWrapper)
    <{{ $componentElement }} class="{{ $class }}" {!! $attribute !!}>
        {!! $slot !!}
    </{{ $componentElement }}>
@elseif(!$href && $keepContent && !$keepWrapper)
    {!! $slot !!}
@endif
