@if($item['children'] && $includeToggle && $item['style'] == "default")
  @button([
      'classList' => [
        $baseClass . '__toggle', 
        is_bool($item['children']) ? 'js-async-children' : ''
      ],
      'style' => 'basic',
      'icon' => 'expand_more',
      'size' => 'md',
      'pressed' => $item['active'] ? 'true' : 'false',
      'aria-label' => ($item['label'] ? ($expandLabel . ': ' . $item['label']) : $expandLabel)
  ])
  @endbutton
@endif
