<!-- icon.blade.php -->
@if ($icon)
    <{{ $componentElement }} class="{{ $class }}" {!! $attribute !!}>
        @if ($isSvgLink)
            <img src="{{ $icon }}" alt="{{ $label }}" />
        @endif
        @if ($svgPath) 
            {!! $svgPath !!}
        @endif
    </{{ $componentElement }}>
@endif
