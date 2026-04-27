@element([
    'classList' => $classList,
    'attributeList' => $attributeList
])
<!-- This is a message component, it will be used as a template for both user messages and reply messages. -->
    {!! $slot !!}
@endelement