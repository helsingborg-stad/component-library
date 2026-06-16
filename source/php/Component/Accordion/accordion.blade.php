@element(['classList' => $classList ?? [], 'attributeList' => $attributeList ?? []])
    @includeWhen(!empty($heading), 'Accordion.partials.heading')
    @foreach($list as $item)
        @accordion__item($item)
        @endaccordion__item
    @endforeach
    {!! $slot !!}
@endelement