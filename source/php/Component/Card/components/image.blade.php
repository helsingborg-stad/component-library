
<div class="{{$baseClass}}__image-container">
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
</div>
