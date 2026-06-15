
@card__image
    @image([
        'src' => is_array($image) ? ($image['src'] ?? null) : $image,
        'alt' => is_array($image) ? ($image['alt'] ?? null) : null,
        'cover' => true,
        'classList' => [
            $baseClass . '__image'
        ],
        'placeholderEnabled' => $hasPlaceholder,
    ])
    @endimage
@endcard__image
