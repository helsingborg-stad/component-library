
@foreach($icons as $icon)
    @icon([
        'icon' => $icon['icon'],
        'size' => $icon['size'] ?? 'md',
        'filled' => $icon['filled'] ?? false,
        'attributeList' => $icon['attributes'] ?? ['data-like-icon' => '', 'data-post-id' => $postId],
        'classList' => ['c-card__icon'],
    ])
    @endicon
@endforeach