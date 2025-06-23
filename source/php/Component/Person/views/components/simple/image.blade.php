@if ($image)
    @image([
        'src' => $image,
        'alt' => $fullName,
        'classList' => ['c-person__image', 'u-margin__top--0']
    ])
    @endimage
@endif

@if (!$image && $useAvatarFallback)
    @avatar([
        'name' => $fullName,
        'classList' => ['c-person__avatar']
    ])
    @endavatar
@endif
