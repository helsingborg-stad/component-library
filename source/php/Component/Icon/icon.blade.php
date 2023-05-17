<!-- icon.blade.php -->
@if ($icon)
    <{{ $componentElement }} class="{{ $class }}" {!! $attribute !!}>
        <span data-nosnippet aria-hidden="true">
            @if ($isSvg)
                <img src="{{ $icon }}" alt="{{ $label }}" />
            @else
                {{ $icon }}{{ $filled ? '' : '_outline' }}
            @endif
        </span>
        </{{ $componentElement }}>
@endif
