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
      'attributeList' => ['style' => $item['color'] ? 'background-color:' . $item['color'] . ';' : '']
    ])
    @endicon
    <span class="{{$baseClass}}__text" style="{{$item['color'] ? 'color:' . $item['color'] . ';' : ''}}">{{$item['label']}}</span>
  @endlink
@else
  <!-- Hidden link: Both label and icon is missing -->
@endif