@button([
    'id' => $id . " - " . $item['id'] ."-" . $loop->index . "__label",
    'icon' => isset($item['icon']['icon']) ? $item['icon']['icon'] : false,
    'reversePositions' => true,
    'text' => $item['label'],
    'style' => 'filled',
    'color' => 'primary',
    'href' => $item['href'],
    'classList' => [
        $baseClass . '__button',
    ],
    'attributeList' => [
        'aria-label' => $item['label']
    ]
])
@endbutton