@includeWhen($image && $image['src'], 'Card.components.image')
@includeWhen($image && $image['src'] && $dateBadge && $date, 'Card.components.datebadge')
@includeWhen($collapsible || $heading || $subHeading || $meta || ($date && !$dateBadge) || $content || $tags || $buttons, 'Card.partials.body')
 {{-- @includeWhen(($hasFooter && $tags) || ($hasFooter && $buttons) , 'Card.partials.footer') --}}