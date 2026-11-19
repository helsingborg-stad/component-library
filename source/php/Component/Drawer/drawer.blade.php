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
    @element([
        'componentElement' => 'nav',
        'classList' => $classList,
        'attributeList' => $attributeList,
    ])
        @include('Drawer.partials.header')
        @include('Drawer.partials.body')
        @if ($afterMenuSlotHasData)
            {!! $afterMenu !!}
        @endif
    @endelement
@endpopover