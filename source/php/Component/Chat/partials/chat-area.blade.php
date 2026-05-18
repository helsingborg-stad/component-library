@element([
    'classList' => [
        $baseClass . '__message-area'
    ],
    'attributeList' => [
        'data-js-message-area' => true
    ]
])
    @element([
        'classList' => [
            $baseClass . '__messages',
        ],
        'attributeList' => [
            'data-js-messages-container' => true
        ]
    ])
        <!-- Messages will be dynamically inserted here -->
    @endelement
@endelement

@if($belowChatAreaSlotHasContent)
    {!! $belowChatArea !!}
@endif

@element([
    'classList' => [
        $baseClass . '__input-area',
    ],
])
    @chat__input($chatInputData)
    @endchat__input
@endelement