<!-- inlineCssWrapper.blade.php -->
@if(!empty($styles))
    <{{$componentElement}} class="{{ $class }}" {!! $attribute !!}>
        {!! $slot !!}
    </{{$componentElement}}>
@else
    {!! $slot !!}
@endif
