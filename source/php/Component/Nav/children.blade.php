@if(is_array($item['children']))
  @nav([
    'items' => $item['children'],
    'includeToggle' => $includeToggle,
    'depth' =>  $depth ? $depth + 1 : 2,
    'direction' => 'vertical',
    'height' => 'sm',
    'classList' => [
      $baseClass . '--bordered'
    ],
    'expandIcon' => $expandIcon,
  ])
  @endnav
@endif