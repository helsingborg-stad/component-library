<!-- typography.blade.php {{ $isPromotedHeading ? '(promoted)' : '' }} -->
<{{ $element }} id="{{ $id }}" class="{{ $class }}" {!! $attribute !!}>
    {{ $slot }}
</{{ $element }}>