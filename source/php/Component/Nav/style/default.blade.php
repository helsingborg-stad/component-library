@if($item['icon'] || $item['label'])
  @link([
    'id' => $id . '-' . $item['id'] . '-' . $loop->index . '__label',
    'classList' => [$baseClass . '__link'],
    'href' => $item['href'],
  ])
    @icon([
      'icon' => $item['icon']['icon'],
      'size' => $item['icon']['size'],
      'classList' => $item['icon']['classList'],
      'attributeList' => ['style' => $item['iconBackgroundColor'] ? 'background-color:' . $item['iconBackgroundColor'] . ';' : '']
    ])@endicon
    <span class="{{$baseClass}}__text">{{$item['label']}}</span>
  @endlink
@else
  <!-- Hidden link: Both label and icon is missing -->
@endif