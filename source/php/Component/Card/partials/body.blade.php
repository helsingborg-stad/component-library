@card__body
    @includeWhen($dateBadge && $date, 'Card.components.datebadge')
    @if($floatingSlotHasData)
        @card__floating
            {!! $floating !!}
        @endcard__floating
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
@endcard__body