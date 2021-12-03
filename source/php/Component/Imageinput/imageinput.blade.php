@fileinput([
'id' => $id . '-input',
'name' => $name,
'display' => 'area',
'multiple' => $multiple,
'label' => __('Upload an image', 'event-integration'),
'accept' => "image/gif, image/jpeg, image/png",
'attributeList' => [
'required' => 'required'
]
])
test
@endfileinput
