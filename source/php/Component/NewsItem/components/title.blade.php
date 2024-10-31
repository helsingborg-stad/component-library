<div class="{{$baseClass}}__title">
    <div class="{{$baseClass}}__title-left">
        @includeWhen($heading, 'NewsItem.partials.heading')
        @if($titleLeftAreaSlotHasData)
            {!! $titleLeftArea !!}
        @endif
    </div>
    <div class="{{$baseClass}}__title-right">
        @if($titleRightAreaSlotHasData)
            {!! $titleRightArea !!}
        @endif
    </div>
</div>