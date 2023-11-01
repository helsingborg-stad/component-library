@link([
    'href' => $link,
    'classList' => ['c-segment__image'],
    'keepContent' => true,
    'keepWrapper' => false,
    'attributeList' => [
        'aria-label' => $lang['visit'] . ': ' . $link,
    ]
])
    <div class="{{ $baseClass }}__image {{ $imageClass }}" style="{{ $imageStyleString }}"></div>
@endlink