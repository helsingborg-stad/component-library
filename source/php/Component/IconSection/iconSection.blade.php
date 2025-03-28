@paper([
    'classList' => array_merge(
        [
            $baseClass
        ],
        $classList ?? []
    )
])
    @include('IconSection.partials.icon')
    @include('IconSection.partials.content')
@endpaper