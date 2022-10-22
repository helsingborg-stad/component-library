<!-- typography.blade.php -->
<{{ $element }} class="{{ $class }}" {!! $attribute !!}>
    @notice([
        'type' => $type,
        'message' => $message,
        'icon' => $icon
    ])
    @endnotice
</{{ $element }}>