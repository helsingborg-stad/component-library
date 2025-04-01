@element([
    'classList' => array_merge(
        [
            $baseClass
        ],
        $classList ?? []
    ),
    'attributeList' => $attributeList ?? []
])
    {!! $slot !!}
@endelement