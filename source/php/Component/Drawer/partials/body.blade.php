@element([
    'classList' => [$baseClass . '__body']
])
    {{-- Placed in another file, due to ajax loading --}}
    @if($menuSlotHasData)
        {!! $menu !!}
    @endif
@endelement