<div class="{{$baseClass}}__title">
    <div class="{{$baseClass}}__title-left {{!$titleRightAreaSlotHasData ? 'cover' : ''}}">
        @includeWhen($heading, 'NewsItem.partials.heading')
        @if($titleLeftAreaSlotHasData)
            {!! $titleLeftArea !!}
        @endif
    </div>
    @if($titleRightAreaSlotHasData)
        <div class="{{$baseClass}}__title-right">
                {!! $titleRightArea !!}
        </div>
    @endif
</div>