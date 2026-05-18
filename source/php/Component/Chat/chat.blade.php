@element([
    'classList' => array_merge(
        [
            $baseClass,
            'o-layout-grid',
            'o-layout-grid--cq',
        ],
        $classList
    ),
    'attributeList' => $attributeList
])
    @includeWhen($title || $titleAreaSlotHasContent, 'Chat.partials.title-area')
    @include('Chat.partials.chat-area')
    @if($belowChatAreaSlotHasContent)
        {!! $belowChatArea !!}
    @endif
    @include('Chat.partials.message-template')
@endelement