@image([
    'src' => is_array($image) ? ($image['src'] ?? null) : $image,
    'alt' => is_array($image) ? ($image['alt'] ?? null) : null,
    'classList' => [
        $baseClass . '__image'
    ]
])
@endimage