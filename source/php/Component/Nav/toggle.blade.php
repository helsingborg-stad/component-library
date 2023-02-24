@if($item['children'] && $includeToggle && $item['style'] == "default")
  @button([
      'classList' => [$baseClass . '__toggle'],
      'style' => 'basic',
      'icon' => 'expand_more',
      'size' => 'md',
      'pressed' => $item['active'] ? 'true' : 'false',
      'aria-label' => ($item['label'] ? ($expandLabel . ': ' . $item['label']) : $expandLabel)
  ])
  @endbutton
@endif
