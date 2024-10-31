<div class="{{$baseClass}}__header">
    <div class="{{$baseClass}}__header-left">
        @includeWhen($subHeading, 'NewsItem.partials.subHeading')
        @if ($headerLeftAreaSlotHasData)
            {!! $headerLeftArea !!}
        @endif
    </div>   
    
    <div class="{{$baseClass}}__header-right">
        @includeWhen($date, 'NewsItem.partials.date')
        @includeWhen($readTime, 'NewsItem.partials.readTime')
        @if ($headerRightAreaSlotHasData)
            {!! $headerRightArea !!}
        @endif
    </div>
</div>