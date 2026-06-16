@element([
    'classList' => [$baseClass . '__heading'],
])
@foreach($heading as $headingItem)
    @element([
        'componentElement' => 'span',
        'classList' => [$baseClass . '__heading-item']
    ])
        {{ $headingItem }}
    @endelement
@endforeach
@endelement