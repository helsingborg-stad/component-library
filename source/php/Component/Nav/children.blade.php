@if(is_array($item['children']))
  @nav([
    'items' => $item['children'],
    'includeToggle' => $includeToggle,
    'depth' =>  $depth + 1,
    'direction' => 'vertical',
    'height' => 'sm',
    'classList' => [
      $baseClass . '--bordered'
    ]
  ])
  @endnav
@endif