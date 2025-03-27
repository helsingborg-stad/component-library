@element([
    'classList' => [
        $baseClass . '__content'
    ]
])
    {!! $slot !!}
@endelement