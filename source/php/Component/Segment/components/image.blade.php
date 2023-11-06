@link([
    'href' => $link['url'],
    'classList' => ['c-segment__image'],
    'keepContent' => true,
    'keepWrapper' => false,
    'attributeList' => [
        'aria-label' => $link['ariaLabel'],
    ]
])
    <div class="{{ $baseClass }}__image {{ $imageClass }}" style="{{ $imageStyleString }}"></div>
@endlink
