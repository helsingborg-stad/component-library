<div class="{{$baseClass}}__image">
    @image([
        'src' => (is_array($image) && isset($image['src'])) ? $image['src'] : $image,
        'alt' => $alt ?? null,
        'classList' => [$baseClass . '__image'],
        'cover' => true
    ])
    @endimage
</div>