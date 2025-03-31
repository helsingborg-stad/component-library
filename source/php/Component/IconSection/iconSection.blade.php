@element([
    'classList' => array_merge(
        [
            $baseClass
        ],
        $classList ?? []
    )
])
    {!! $slot !!}
@endelement