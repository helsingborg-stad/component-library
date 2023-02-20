@link([
  'id' => $id . '-' . $item['id'] . '-' . $loop->index . '__label',
  'classList' => [$baseClass . '__link'],
  'href' => $item['href'],
])
  @icon($item['icon'])@endicon
  <span class="{{$baseClass}}__text">{{$item['label']}}</span>
@endlink