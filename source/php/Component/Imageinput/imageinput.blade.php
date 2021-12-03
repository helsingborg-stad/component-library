<div class="{{$baseClass}}">
    <div id="{{ $id }}" class="{{$baseClass}}__preview">
        <div class="{{$baseClass}}__image material-icons">
            <img src="" style="display:none" />
        </div>
        <span>Bildnamn.jpg, 1200*700px, 234kb</span>
    </div>
    @fileinput([
        'id' => $id . '-input',
        'name' => $name,
        'display' => 'area',
        'multiple' => $multiple,
        'label' => __('Upload an image', 'event-integration'),
        'accept' => "image/gif, image/jpeg, image/png",
        'attributeList' => [
            'required' => 'required',
            'data-image-preview' => $id
        ]
    ])
    @endfileinput
</div>
