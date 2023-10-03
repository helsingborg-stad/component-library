@includeWhen($image && !empty($image['src']), 'Card.components.image')
@includeWhen($dateBadge && $date, 'Card.components.datebadge')
@includeWhen($collapsible || $heading || $subHeading || $meta || $date || $content || $floatingSlotHasData, 'Card.partials.body')
@includeWhen($tags || $buttons, 'Card.partials.footer')
