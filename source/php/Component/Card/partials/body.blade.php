<div class="{{$baseClass}}__body">
    @includeWhen($dateBadge && $date, 'Card.components.datebadge')
    @if($floatingSlotHasData)
        <div class="{{$baseClass}}__floating">
            {!! $floating !!}
        </div>
    @endif
    @includeWhen($meta && $metaFirst, 'Card.components.meta')
    @includeWhen($heading || $subHeading || ($meta && !$metaFirst) || $icon, 'Card.components.heading')
    @includeWhen($date && !$dateBadge, 'Card.components.date')
    @includeWhen($content, 'Card.components.content')
 </div>