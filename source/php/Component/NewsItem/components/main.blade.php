<div class="{{$baseClass}}__main">
    <div class="{{$baseClass}}__main-left">
        @includeWhen($content, 'NewsItem.partials.content')
        @if($contentLeftAreaSlotHasData)
            {!! $contentLeftArea !!}
        @endif
    </div>
    <div class="{{$baseClass}}__main-right">
        @includeWhen($image, 'NewsItem.partials.image')
        @if($contentRightAreaSlotHasData)
            {!! $contentRightArea !!}
        @endif
    </div>
</div>