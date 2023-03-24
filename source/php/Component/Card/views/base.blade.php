@if($floatingSlotHasData)
<div class="{{$baseClass}}__floating">
    {!! $floating !!}
</div>
@endif
@includeWhen($image && !empty($image['src']), 'Card.components.image')
@includeWhen($image && !empty($image['src']) && $dateBadge && $date, 'Card.components.datebadge')
@includeWhen($collapsible || $heading || $subHeading || $meta || ($date && !$dateBadge) || $content, 'Card.partials.body')
@includeWhen($tags || $buttons, 'Card.partials.footer')