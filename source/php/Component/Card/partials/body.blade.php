<div class="{{$baseClass}}__body">
    @includeWhen($dateBadge && $date, 'Card.components.datebadge')
    @if($floatingSlotHasData)
        <div class="{{$baseClass}}__floating">
            {!! $floating !!}
        </div>
    @endif
    @includeWhen($meta && $metaFirst, 'Card.components.meta')
    @includeWhen(($heading || $subHeading || ($meta && !$metaFirst) || $icon) && !$headingAboveImage, 'Card.components.heading')
    @includeWhen($date && $date['timestamp'] && !$dateBadge, 'Card.components.date')
    @if ($aboveContentSlotHasData)
        {!! $aboveContent !!}
    @endif
    @includeWhen($content, 'Card.components.content')
    @includeWhen($link && !empty($linkText), 'Card.components.linkText')
    @if($belowContentSlotHasData)
        {!! $belowContent !!}
    @endif
 </div>