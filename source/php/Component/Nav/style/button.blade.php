@button([
    'id' => $id . " - " . $item['id'] ."-" . $loop->index . "__label",
    'icon' => isset($item['icon']['icon']) ? $item['icon']['icon'] : false,
    'reversePositions' => true,
    'text' => $item['label'],
    'style' => $item['buttonStyle'] ?? $buttonStyle,
    'color' => $item['buttonColor'] ?? $buttonColor,
    'href' => strlen($item['href']) <= 1 ? null : $item['href'],
    'classList' => [
        $baseClass . '__button',
    ],
    'attributeList' => [
        'aria-label' => $item['label']
    ],
    'context' => [
        'component.nav.button'
    ],
    'size' => $height == 'sm' ? 'sm' : 'md'
])
@endbutton