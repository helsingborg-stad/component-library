<{{ $element }} class="{{ $class }}" {!! $attribute !!}>
    @nav([
        'items' => $items,
        'classList' => [
            $baseClass . '__items'
        ],
        'direction' => 'horizontal',
        'includeToggle' => true
    ])
    @endnav
</{{ $element }}>