@element([
    'classList' => $classList,
    'attributeList' => $attributeList
])
    @element([
        'componentElement' => 'div',
        'classList' => [
            $baseClass . '__editable',
        ],
        'attributeList' => [
            'contenteditable' => 'true',
            'role' => 'textbox',
            'aria-multiline' => 'true',
            'aria-label' => $placeholder ?? '',
            'data-js-chat-editable' => true,
        ]
    ])
        <!-- input area -->
    @endelement
    @element([
        'classList' => [
            $baseClass . '__actions',
        ],
        'attributeList' => [
            'data-js-chat-actions' => true,
        ]
    ])
        @button([
            'text' => $sendButtonText ?? 'Send',
            'color' => 'primary',
            'style' => 'filled',
            'type' => 'button',
            'attributeList' => [
                'data-js-chat-send' => true,
            ]
        ])
        @endbutton
    @endelement
@endelement