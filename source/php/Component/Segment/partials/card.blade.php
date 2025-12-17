<div class="{{$baseClass}}__content">
    @card([
        'link' => empty($buttons) ? $link : false,
        'classList' => [$baseClass . '__content-card']
    ])
    @include('Segment.components.content', ['link' => !empty($buttons) ? $link : false])
    @if ($isBlock)
        <div class="{{$baseClass}}__inner-blocks u-hide-empty">{!! '<InnerBlocks />' !!}</div>
    @endif
    @endcard
</div>
