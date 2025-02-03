<div class="{{$baseClass}}__main-left {{!$image && !$hasPlaceholderImage && !$contentRightAreaSlotHasData ? 'cover' : ''}}">
    @includeWhen($content, 'NewsItem.partials.content')
    @if($contentLeftAreaSlotHasData)
        {!! $contentLeftArea !!}
    @endif
</div>

@if ($image || $hasPlaceholderImage || $contentRightAreaSlotHasData)
    <div class="{{$baseClass}}__main-right">
        @includeWhen($image || $hasPlaceholderImage, 'NewsItem.partials.image')
        @if($contentRightAreaSlotHasData)
            {!! $contentRightArea !!}
        @endif
    </div>
@endif