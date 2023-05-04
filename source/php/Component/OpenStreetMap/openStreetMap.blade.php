<div class="{{ $class }}" {!! $attribute !!}>
    <div class="{{$baseClass}}__map" style="height:{{$height}};" id="openstreetmap__map-{{$id}}">
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