<div class="{{$baseClass}}__content o-container o-container--content o-container--keep-spacing">
    <div class="{{$baseClass}}__padder">
        @include('Segment.components.content')
    </div>
</div>

@if ($slotHasData)
    <div class="{{$baseClass}}__slot o-container">
        {{ $slot }}
    </div>
@endif

{{-- Oneline to enable the use of css:empty() function --}}
<div class="{{$baseClass}}__inner-blocks o-container u-margin__x--auto u-hide-empty">{!! '<InnerBlocks />' !!}</div>
