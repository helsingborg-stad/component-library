<div class="{{$class}}" {!! $attribute !!}>
    <div style="height:{{$height}};" id="openstreetmap__map">
        @icon([
            'icon' => 'map',
            'size' => 'lg',
            'classList' => ['openstreetmap__expand-icon', 'u-level-1'],
            'attributeList' => ['data-js-toggle-trigger' => 'expand']
        ])
        @endicon
    </div>
    {!! $slot !!}
    @includeWhen($sidebarContentHasData, 'OpenStreetMap.partials.sidebar')
</div>