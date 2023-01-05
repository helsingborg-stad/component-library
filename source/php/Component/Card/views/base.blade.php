@includeWhen($image && !empty($image['src']), 'Card.components.image')
@includeWhen($image && !empty($image['src']) && $dateBadge && $date, 'Card.components.datebadge')
@includeWhen($collapsible || $heading || $subHeading || $meta || ($date && !$dateBadge) || $content || $tags || $buttons, 'Card.partials.body')