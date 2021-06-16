<!-- icon.blade.php -->
@if($icon)
    <{{$componentElement}} id="{{ $id }}" class="{{ $class }} material-icons" {!! $attribute !!} translate="no">
        @if($icon)
            {{$icon}}
        @else 
            {{$slot}}
        @endif
    </{{$componentElement}}>
@endif