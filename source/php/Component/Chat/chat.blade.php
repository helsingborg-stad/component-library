@element([
    'classList' => array_merge(
        [
            $baseClass,
            'o-layout-grid',
            'o-layout-grid--cq',
            'o-layout-grid--gap-4'
        ],
        $classList
    ),
    'attributeList' => $attributeList
])
    @includeWhen($title, 'Chat.partials.title-area')
    @include('Chat.partials.chat-area')
    @include('Chat.partials.message-template')
@endelement