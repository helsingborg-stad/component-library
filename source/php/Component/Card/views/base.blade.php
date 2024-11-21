@includeWhen(
  $imageExists || ($hasPlaceholder && !$imageExists), 
  'Card.components.image'
)
@includeWhen($collapsible || $heading || $subHeading || $meta || $date || $content || $floatingSlotHasData, 'Card.partials.body')
@includeWhen($tags || $buttons, 'Card.partials.footer')
