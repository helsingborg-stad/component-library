@button([
    'style' => 'basic',
    'size' => 'md',
    'toggle' => true,
    "attributeList" => [
        'js-toggle-trigger' => $collpaseID,
        'data-toggle-icon' => 'close'
    ],
    'icon' => 'expand_more',
    'classList' => [$baseClass . '__title-expand-button']
])
@endbutton