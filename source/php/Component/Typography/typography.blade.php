<!-- typography.blade.php {{ $isPromotedHeading ? '(promoted)' : '' }} -->
<{{ $element }} class="{{ $class }}" {!! $attribute !!}>
    {{ $slot }}
</{{ $element }}>