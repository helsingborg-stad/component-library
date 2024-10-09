@link([
    'href' => $link,
    'classList' => ['c-segment__image-container'],
    'keepContent' => true,
    'keepWrapper' => false,
    'attributeList' => [
        'aria-label' => $lang->visit . ': ' . $link,
    ]
])
    @image([
        'src' => $image,
        'alt' => $imageAlt ?? null,
        'classList' => $imageClassList ?? []
    ])
    @endimage
@endlink