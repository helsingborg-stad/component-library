@element([
    'classList' => [
        $baseClass . '__image-container'
    ],
])
    @image([
        'src' => is_array($image) ? ($image['src'] ?? null) : $image,
        'alt' => is_array($image) ? ($image['alt'] ?? null) : null,
        'classList' => [
            $baseClass . '__image'
        ],
        'cover' => true,
        'placeholderEnabled' => $hasPlaceholderImage,
    ])
    @endimage
@endelement