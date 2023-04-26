@link([
    'href' => $link,
    'classList' => ['c-segment__image'],
    'keepContent' => true,
    'keepWrapper' => false
])
    <div class="{{ $baseClass }}__image {{ $imageClass }}" style="{{ $imageStyleString }}"></div>
@endlink
