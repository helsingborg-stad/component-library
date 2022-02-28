@includeWhen($image, 'Block.components.image')
@includeWhen($heading || $subHeading || $content || $collapsible, 'Block.partials.body')
@includeWhen($tags || $buttons, 'Block.partials.footer')