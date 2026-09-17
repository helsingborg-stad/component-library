<!-- typography.blade.php {{ $isPromotedHeading ? '(promoted)' : '' }}{{$hasSeenH1 ? ' (hasSeenH1)' : ''}} {{ !empty($originalElement) ? ' original: ' . $originalElement : '' }} -->
<{{ $element }} class="{{ $class }}" {!! $attribute !!}>
    @if (!is_array($slot))
        {{ $slot }}
    @else 
    THISISANARRAY!!! <?php echo print_r($slot, true); ?>
    @endif
</{{ $element }}>
