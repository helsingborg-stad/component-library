<div class="{{$baseClass}}__body">
    @if($floatingSlotHasData)
        <div class="{{$baseClass}}__floating">
            {!! $floating !!}
        </div>
    @endif
    @includeWhen($meta && $metaFirst, 'Card.components.meta')
    @includeWhen($heading || $subHeading || ($meta && !$metaFirst) || $icon || (!$image || empty($image['src'] && ($dateBadge && $date))), 'Card.components.heading')
    @includeWhen($date && !$dateBadge, 'Card.components.date')
    @includeWhen($content, 'Card.components.content')
 </div>