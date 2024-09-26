@image([
    'src' => (is_array($image) && isset($image['src'])) ? $image['src'] : $image,
    'alt' => $alt ?? null,
    'classList' => [$baseClass . '__image']
])
@endimage