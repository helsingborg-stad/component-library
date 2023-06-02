<div class="{{$baseClass}}__body">
    @includeWhen($collapsible, 'Card.components.collapsiableButton')
    @includeWhen($meta && $metaFirst, 'Card.components.meta')
    @includeWhen($heading || ($meta && !$metaFirst) || $icon || (!$image || empty($image['src'] && ($dateBadge && $date))), 'Card.components.heading')
    @includeWhen($subHeading, 'Card.components.subHeading')
    @includeWhen($date && !$dateBadge, 'Card.components.date')
    @includeWhen($content, 'Card.components.content')
 </div>