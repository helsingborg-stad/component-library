@if ($link)
    @link([
        'href' => $link,
        'classList' => ['c-segment__image']
    ])
    @endif
    <div class="{{ $baseClass }}__image {{ $imageClass }}" style="{{ $imageStyleString }}"></div>
    @if ($link)
    @endlink
@endif
