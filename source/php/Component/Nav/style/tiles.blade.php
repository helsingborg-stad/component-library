@if($item['icon'] || $item['label'])
  @link([
    'id' => $id . '-' . $item['id'] . '-' . $loop->index . '__label',
    'classList' => [
        $baseClass . '__link',
        'c-paper',
        'u-margin__bottom--1'
    ],
    'href' => $item['href'],
    'xfn' => $item['xfn'],
  ])
    @icon($item['icon'])@endicon
    <span class="{{$baseClass}}__text">{{$item['label']}}</span>
  @endlink
@else
  <!-- Hidden link: Both label and icon is missing -->
@endif