<!-- icon.blade.php -->
@if($icon)
    <{{$componentElement}} class="{{ $class }}" {!! $attribute !!}>
        <span aria-hidden="true">{{$icon}}{{$filled ? '' : '_outline'}}</span>
    </{{$componentElement}}>
@endif