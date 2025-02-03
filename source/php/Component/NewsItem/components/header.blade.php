<div class="{{$baseClass}}__header">
    <div class="{{$baseClass}}__header-left">
        @if ($subHeading || $headerLeftAreaSlotHasData)
            @includeWhen($subHeading, 'NewsItem.partials.subHeading')
            @if ($headerLeftAreaSlotHasData)
                {!! $headerLeftArea !!}
            @endif
        @endif
    </div>
    @if ($headerRightAreaSlotHasData || $date || $readTime)
        <div class="{{$baseClass}}__header-right">
            @includeWhen($date, 'NewsItem.partials.date')
            @includeWhen($readTime, 'NewsItem.partials.readTime')
            @if ($headerRightAreaSlotHasData)
                {!! $headerRightArea !!}
            @endif
        </div>
    @endif
</div>