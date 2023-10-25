<!-- typography.blade.php {{ $isPromotedHeading ? '(promoted)' : '' }}{{$hasSeenH1 ? ' (hasSeenH1)' : ''}} {{ !empty($originalElement) ? ' original: ' . $originalElement : '' }} -->
<{{ $element }} class="{{ $class }}" {!! $attribute !!}>
    {{ $slot }}
</{{ $element }}>