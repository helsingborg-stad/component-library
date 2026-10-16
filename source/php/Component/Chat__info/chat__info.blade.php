@element([
    'classList' => $classList,
    'attributeList' => $attributeList
])
    <!-- This is an info component, it will be used to display informational messages within the chat. -->
    @element([
        'attributeList' => [
            'data-js-chat-info' => true
        ],
        'classList' => [
            $baseClass . '__info',
        ]
    ])
        <!-- Info content will be dynamically inserted here -->
        {!! $slot !!}
    @endelement
@endelement
