<div class="openstreetmap__sidebar">
    <div class="openstreetmap__container" js-pagination-target>
        @if ($title)
            @typography([
                'id' => 'mod-posts-' . $ID . '-label',
                'element' => 'h2',
                'variant' => 'h2',
                'classList' => ['module-title']
            ])
                {!! $postTitle !!}
            @endtypography
        @endif
        <div class="openstreetmap__inner-blocks u-hide-empty">{!! '<InnerBlocks />' !!}</div>
        {!! $sidebarContent !!}
        @include('OpenStreetMap.partials.pagination')
    </div>
</div>