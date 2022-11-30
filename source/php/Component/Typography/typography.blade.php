<!-- typography.blade.php {{ $isPromotedHeading ? '(promoted)' : '' }} -->
<{{ $element }} class="{{ $class }}" {!! $attribute !!}>
    {!! htmlentities($slot) !!}
</{{ $element }}>
