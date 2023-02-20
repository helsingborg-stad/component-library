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

@if(is_array($item['children'])) 
  @nav([
    'items' => $item['children'],
    'isExpanded' => ((isset($item['active']) && boolval($item['active'])) || (isset($item['ancestor']) &&  boolval($item['ancestor']) )) ? true : false,
    'includeToggle' => $includeToggle,
    'depth' =>  $depth + 1,
    'direction' => $direction
  ])
  @endnav
@endif