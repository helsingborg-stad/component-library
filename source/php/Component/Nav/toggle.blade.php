@if($item['children'] && $includeToggle && $item['style'] == "default")
  @button([
      'classList' => [
        $baseClass . '__toggle', 
        is_bool($item['children']) ? 'js-async-children' : ''
      ],
      'style' => 'basic',
      'icon' => $expandIcon ?: 'expand_more',
      'size' => 'md',
      'pressed' => $item['active'] ? 'true' : 'false',
      'attributeList' => [
        'aria-label' => $getExpandLabel($item['label'], $expandLabel)
      ]
  ])
  @endbutton
@endif
