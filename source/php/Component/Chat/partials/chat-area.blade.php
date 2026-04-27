@element([
    'componentElement' => 'div',
])
    @element([
        'classList' => [
            $baseClass . '__message-area',
        ],
        'attributeList' => [
            'data-js-message-area' => true,
        ]
    ])
        <!-- Messages will be dynamically inserted here -->
    @endelement
    @chat__input([
    ])
    @endchat__input
    {{-- @form([
        'action' => '#',
        'method' => 'POST',
        'classList' => ['u-display--flex', 'u-flex-direction--column', 'u-gap-2'],
        'attributeList' => ['data-js-chat-form' => true],
        'validation' => false
    ])
        @field([
            'type' => 'text',
            'placeholder' => 'Type your message here...',
            'multiline' => true,
            'classList' => [
                $baseClass . '__input'
            ],
            'attributeList' => [
                'data-js-message-input' => true,
            ],
            'fieldAttributeList' => [
                "style" => "resize: none;",
            ]
        ])
        @endfield
        @button([
            'text' => 'send',
            'color' => 'primary',
            'style' => 'filled',
            'type' => 'submit',
        ])
        @endbutton
    @endform --}}
@endelement