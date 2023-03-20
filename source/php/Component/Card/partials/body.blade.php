<div class="{{$baseClass}}__body">
    @includeWhen($collapsible, 'Card.components.collapsiableButton')
    @includeWhen($meta && $metaFirst, 'Card.components.meta')
    @includeWhen($heading || ($meta && !$metaFirst) || $icon, 'Card.components.heading')
    @includeWhen($subHeading, 'Card.components.subHeading')
    {{-- @includeWhen($meta && !$metaFirst, 'Card.components.meta') --}}
    @includeWhen($date, 'Card.components.date')
    @includeWhen($content, 'Card.components.content')
 </div>