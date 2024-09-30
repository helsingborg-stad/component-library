@image([
  'classList' => [$baseClass . '__image'],
  'src' => $image,
  'alt' => $alt ?? null,
  'cover' => true,
  'context' => ['component.slider', 'component.slider.image']
])
@endimage