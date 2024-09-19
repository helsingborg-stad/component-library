@link([
    'href' => $link,
    'classList' => ['c-segment__image'],
    'keepContent' => true,
    'keepWrapper' => false,
    'attributeList' => [
        'aria-label' => $lang->visit . ': ' . $link,
    ]
])
    @image([
        'src' => $image,
        'fullWidth' => true,
        'classList' => ['c-segment__image'],
    ])
    @endimage
@endlink