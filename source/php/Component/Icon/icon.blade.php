<!-- icon.blade.php -->
@if ($icon)
    <{{ $componentElement }} class="{{ $class }}" {!! $attribute !!}>
        @if ($isSvg)
            <img src="{{ $icon }}" alt="{{ $label }}" />
        @endif
    </{{ $componentElement }}>
@endif
