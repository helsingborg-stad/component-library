<!-- nav.blade.php -->
@if ($items) 
  @if ($depth > 1)
        @element([
            'classList' => [
                'c-nav__child-container',
            ]
        ])
            @include('Nav.content')
        @endelement
    @else
        @include('Nav.content')
    @endif
@endif