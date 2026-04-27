@element([
    'componentElement' => 'template',
    'attributeList' => [
        'data-js-user-message-template' => 'true',
    ]
])
    @chat__message([
        'isReply' => false,
    ])
        <!-- user message -->
    @endchat__message
@endelement

@element([
    'componentElement' => 'template',
    'attributeList' => [
        'data-js-reply-message-template' => 'true',
    ]
])
    @chat__message([
        'isReply' => true,
    ])
        <!-- reply message -->
    @endchat__message
@endelement