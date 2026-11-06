@link([
    'href' => $link,
    'classList' => ['c-segment__image-container'],
    'keepContent' => true,
    'keepWrapper' => $layout === 'card',
    'attributeList' => [
        'aria-label' => (is_object($lang) ? ($lang->visit ?? '') : ($lang['visit'] ?? '')) . ': ' . $link,
    ]
])
    @image([
        'src' => $image,
        'alt' => $imageAlt ?? null,
        'classList' => $imageClassList ?? [],
        'calculateAspectRatio' => false,
        'lqipEnabled' => $layout == 'featured' ? false : true,
    ])
    @endimage
@endlink
