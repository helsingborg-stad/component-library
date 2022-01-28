<div class="{{$baseClass}}">
    <div id="{{$id}}" class="{{$baseClass}}__preview">
        <div class="{{$baseClass}}__image material-icons">
            <img src="" class="u-visibility--hidden" />
        </div>
        <span></span>
    </div>
    @fileinput([
        'id' => $id . '-input',
        'name' => $name,
        'display' => 'area',
        'multiple' => $multiple,
        'label' => __('Upload an image', 'event-integration'),
        'accept' => "image/gif, image/jpeg, image/png",
        'classList' => ['u-margin__top--1'],
        'required' => $required,
        'attributeList' => [
            'required' => 'required',
            'data-image-preview' => $id
        ]
    ])
    @endfileinput
</div>
