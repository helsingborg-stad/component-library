@includeWhen($headingAboveImage, 'Card.partials.header')

@includeWhen(
  $imageExists || ($hasPlaceholder && !$imageExists), 
  'Card.components.image'
)
@includeWhen(
  $collapsible || 
  $heading || 
  $subHeading || 
  $meta || 
  $date || 
  $content || 
  $linkText || 
  $floatingSlotHasData ||
  $aboveContentSlotHasData ||
  $belowContentSlotHasData,
  'Card.partials.body'
)

@includeWhen($tags || $buttons, 'Card.partials.footer')
