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
    @chat__input($chatInputData)
    @endchat__input
@endelement