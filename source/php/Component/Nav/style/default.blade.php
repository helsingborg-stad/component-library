@link([
  'id' => $id . '-' . $item['id'] . '-' . $loop->index . '__label',
  'classList' => [$baseClass . '__link'],
  'href' => $item['href'],
])
  @if(!empty($item['icon']))
    @icon($item['icon'])
    @endicon
  @endif
  <span class="{{$baseClass}}__text">{{$item['label']}}</span>
@endlink