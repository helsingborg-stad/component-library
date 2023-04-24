@if ($buttons && count($buttons) === 1)
    @link([
        'href' => $buttons[0]['href'],
        'classList' => ['c-segment__image']
    ])
    @endif
    <div class="{{ $baseClass }}__image {{ $imageClass }}" style="{{ $imageStyleString }}"></div>
    @if ($buttons && count($buttons) === 1)
    @endlink
@endif
