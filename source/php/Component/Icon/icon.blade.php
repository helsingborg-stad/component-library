<!-- icon.blade.php -->
@if ($icon)
    <{{ $componentElement }} class="{{ $class }}" {!! $attribute !!}>
        @if ($isSvgLink)
            <img src="{{ $icon }}" alt="{{ $label }}" />
        @endif
        @if (!empty($customSvg)) 
            {!! $customSvg !!}
        @endif
    </{{ $componentElement }}>
@endif
