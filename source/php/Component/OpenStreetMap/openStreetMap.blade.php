<div class="{{$class}}" {!! $attribute !!}>
    <div style="height:{{$height}};" id="openstreetmap__map">
        @if ($sidebarContentHasData)
        @icon([
            'icon' => 'map',
            'size' => 'lg',
            'classList' => [$baseClass . '__expand-icon', 'u-level-1'],
            'attributeList' => ['data-js-toggle-trigger' => 'expand']
        ])
        @endicon
        @endif
    </div>
    @includeWhen($sidebarContentHasData, 'OpenStreetMap.partials.sidebar')
    @include('OpenStreetMap.partials.template')
</div>