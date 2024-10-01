<div class="{{$baseClass}}__image-container">
    @image([
        'src' => is_array($image) ? $image['src'] : $image,
        'alt' => isset($image['alt']) ? $image['alt'] : null,
        'cover' => true,
        'classList' => [
            $baseClass . '__image'
        ]
    ])
    @endimage
</div>