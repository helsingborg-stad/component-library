<div class="{{$baseClass}}__content">
    @card([
        'classList' => [$baseClass . '__content-card']
    ])
    @include('Segment.components.content')
    <div class="{{$baseClass}}__inner-blocks u-hide-empty">{!! '<InnerBlocks />' !!}</div>
    @endcard
</div>
