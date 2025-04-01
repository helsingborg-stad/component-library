@element([
    'classList' => array_merge(
        [
            $baseClass
        ],
        $classList ?? []
    ),
    'attributeList' => $attributeList ?? []
])
    @include('IconSection__item.partials.icon')
    @include('IconSection__item.partials.content')
@endelement