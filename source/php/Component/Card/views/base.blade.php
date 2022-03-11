@includeWhen($image && $image['src'], 'Card.components.image')
@includeWhen($collapsible || $heading || $subHeading || $meta || $date || $content || $tags || $buttons, 'Card.partials.body')