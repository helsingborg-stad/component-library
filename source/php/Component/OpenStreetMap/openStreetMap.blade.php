<div class="{{ $class }}" {!! $attribute !!}>
    <div class="{{$baseClass}}__map" style="height:{{$height}};" id="openstreetmap__map-{{$id}}" tabindex="0">
        @if ($sidebarContentHasData)
        @icon([
            'icon' => 'keyboard_arrow_up',
            'size' => 'lg',
            'classList' => [$baseClass . '__expand-icon-desktop'],
        ])
        @endicon
        @endif
    </div>
    @includeWhen($sidebarContentHasData, 'OpenStreetMap.partials.sidebar')
    @include('OpenStreetMap.partials.template')
</div>