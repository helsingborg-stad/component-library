<!-- icon.blade.php -->
@if($icon)
    <{{$componentElement}} id="{{ $id }}" class="{{ $class }}" {!! $attribute !!}>
        @if($icon)
            {{$icon}}
        @else 
            {{$slot}}
        @endif
    </{{$componentElement}}>
@endif