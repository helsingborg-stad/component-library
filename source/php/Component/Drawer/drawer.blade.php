<!-- drawer.blade.php -->
@if($toggleButtonData)
    @button($toggleButtonData)
    @endbutton
@endif

@popover([
    'id' => $id,
    'horizontalPlacement' => 'right',
    'verticalPlacement' => 'top',
    'backdrop' => true,
    'animation' => 'slide-in-right',
])
    @inheritboundry
    <nav class="{!! $class !!}" {!! $attribute !!}>
        @include('Drawer.partials.header')
        @include('Drawer.partials.body')
        @if ($afterMenuSlotHasData)
            {!! $afterMenu !!}
        @endif
    </nav>
    @endinheritboundry
@endpopover