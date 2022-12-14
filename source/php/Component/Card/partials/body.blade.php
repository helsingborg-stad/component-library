<div class="{{$baseClass}}__body">
    @includeWhen($collapsible, 'Card.components.collapsiableButton')
    @includeWhen($meta && $metaFirst, 'Card.components.meta')
    @includeWhen($heading, 'Card.components.heading')
    @includeWhen($subHeading, 'Card.components.subHeading')
    @includeWhen($meta && !$metaFirst, 'Card.components.meta')
    @includeWhen($date, 'Card.components.date')
    @includeWhen($content, 'Card.components.content')
    @includeWhen($tags, 'Card.components.footer')
 </div>