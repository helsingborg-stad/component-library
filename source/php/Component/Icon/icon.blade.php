<!-- icon.blade.php -->
@if($icon)
    <{{$componentElement}} class="{{ $class }}" {!! $attribute !!}>
        {{$icon}}
    </{{$componentElement}}>
@endif