@if($item['hasToggle'] && $includeToggle && $item['style'] == "default")
  @button([
      'classList' => [
        $baseClass . '__toggle', 
        is_bool($item['children']) ? 'js-async-children' : ''
      ],
      'style' => 'basic',
      'icon' => $expandIcon ?: 'expand_more',
      'size' => 'md',
      'pressed' => ($item['active'] || $item['ancestor']) ? 'true' : 'false',
      'attributeList' => $item['toggleAttributeList'] ?? []
  ])
  @endbutton
@endif
