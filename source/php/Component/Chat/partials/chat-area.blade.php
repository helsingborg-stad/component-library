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
    @element([
        'classList' => [
            $baseClass . '__input-area',
        ],
    ])
        @chat__input($chatInputData)
        @endchat__input
    @endelement
@endelement