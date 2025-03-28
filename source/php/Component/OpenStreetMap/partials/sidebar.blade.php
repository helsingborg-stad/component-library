<div class="{{$baseClass}}__sidebar u-display--none" data-observe-resizes>
    @if ($sidebarContentHasData)
        <div class="{{$baseClass}}__expand-icon-container">
            @icon([
                'icon' => 'keyboard_arrow_up',
                'size' => 'lg',
                'classList' => [$baseClass . '__expand-icon-mobile'],
            ])
            @endicon
        </div>
    @endif
    <div class="{{$baseClass}}__container">
        @if ($isBlock)
            <div class="{{$baseClass}}__inner-blocks u-hide-empty">{!! '<InnerBlocks />' !!}</div>
        @endif
        {!! $sidebarContent !!}
    </div>
</div>