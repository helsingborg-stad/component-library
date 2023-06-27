@link([
    'href' => $link,
    'classList' => ['c-segment__image'],
    'keepContent' => true,
    'keepWrapper' => false
])
    <div role="img" aria-label="{{$imageAlt}}" class="{{ $baseClass }}__image {{ $imageClass }}" style="{{ $imageStyleString }}"></div>
@endlink
