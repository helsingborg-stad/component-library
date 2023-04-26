@if ($href)
<a class="{{ $class }}" id="{{ $id }}" {!! $attribute !!}>
    {!! $slot !!}
</a>
@elseif(!$href && $keepContent && $keepWrapper)
<{{ $componentElement }} class="{{ $class }}" id="{{ $id }}" {!! $attribute !!}>
    {!! $slot !!}
</{{ $componentElement }}>
@elseif(!$href && $keepContent && !$keepWrapper)
{!! $slot !!}
@endif
