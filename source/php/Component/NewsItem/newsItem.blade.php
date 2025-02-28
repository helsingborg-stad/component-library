<{{ $componentElement }} class="{{ $class }}" {!! $attribute !!}>
    @includeWhen($date || $subHeading || $headerLeftAreaSlotHasData || $headerRightAreaSlotHasData, 'NewsItem.components.header')
    @includeWhen($heading || $titleLeftAreaSlotHasData || $titleRightAreaSlotHasData, 'NewsItem.components.title')
    @includeWhen($content || $contentLeftAreaSlotHasData || $contentRightAreaSlotHasData || $image || $hasPlaceholderImage, 'NewsItem.components.main')
</{{ $componentElement }}>