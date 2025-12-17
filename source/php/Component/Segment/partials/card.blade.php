<div class="{{$baseClass}}__content">
    @card([
        'link' => $dynamicLink ?? "",
        'classList' => [$baseClass . '__content-card']
    ])
    @include('Segment.components.content')
    @if ($isBlock)
        <div class="{{$baseClass}}__inner-blocks u-hide-empty">{!! '<InnerBlocks />' !!}</div>
    @endif
    @endcard
</div>
