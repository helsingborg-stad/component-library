<div class="{{$baseClass}}__content o-container o-container--content o-container--keep-spacing">
    <div class="{{$baseClass}}__padder">
        @include('Segment.components.content')
        @if ($isBlock)
            <div class="{{$baseClass}}__inner-blocks u-hide-empty">{!! '<InnerBlocks />' !!}</div>
        @endif
    </div>
</div>
