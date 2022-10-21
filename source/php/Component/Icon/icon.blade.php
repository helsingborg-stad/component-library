<!-- icon.blade.php -->
@if($icon)
    <{{$componentElement}} id="{{ $id }}" class="{{ $class }}" {!! $attribute !!}>
        {{$icon}}
    </{{$componentElement}}>
@endif