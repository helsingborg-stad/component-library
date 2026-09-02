@element([
    'componentElement' => 'tr',
    'classList' => $classList,
    'attributeList' => $attributeList
])
    {!! $slot !!}
@endelement