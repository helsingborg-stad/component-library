<div class="{{$baseClass}}__header">
    @if ($subHeading || $headerLeftAreaSlotHasData)
        <div class="{{$baseClass}}__header-left">
            @includeWhen($subHeading, 'NewsItem.partials.subHeading')
            @if ($headerLeftAreaSlotHasData)
                {!! $headerLeftArea !!}
            @endif
        </div>   
    @endif
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