@if(is_array($item['children']))
  @nav([
    'items' => $item['children'],
    'isExpanded' => ((isset($item['active']) && boolval($item['active'])) || (isset($item['ancestor']) &&  boolval($item['ancestor']) )) ? true : false,
    'includeToggle' => $includeToggle,
    'depth' =>  $depth + 1,
    'direction' => 'vertical',
    'classList' => [
      $baseClass . '--bordered'
    ]
  ])
  @endnav
@endif