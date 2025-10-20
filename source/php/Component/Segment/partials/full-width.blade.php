@if (
    $title ||
    $icon ||
    $meta ||
    $date ||
    $tags ||
    $aboveContentSlotHasData ||
    $content ||
    $belowContentSlotHasData ||
    $buttons
)
    <div class="{{$baseClass}}__content o-container o-container--content o-container--keep-spacing">
        <div class="{{$baseClass}}__padder">
            @include('Segment.components.content')
        </div>
    </div>
@endif

@if ($slotHasData)
    <div class="{{$baseClass}}__slot o-container">
        {{ $slot }}
    </div>
@endif

{{-- Oneline to enable the use of css:empty() function --}}
@if ($isBlock)
    <div class="{{$baseClass}}__inner-blocks o-container u-margin__x--auto u-hide-empty">{!! '<InnerBlocks />' !!}</div>
@endif
