@if($item['icon'] || $item['label'])
  @link([
    'id' => $id . '-' . $item['id'] . '-' . $loop->index . '__label',
    'classList' => [$baseClass . '__link'],
    'href' => $item['href'],
    'xfn' => $item['xfn'] ?? false
  ])
    @icon([
      'icon' => $item['icon']['icon'] ?? null,
      'size' => $item['icon']['size'] ?? null,
      'filled' => $item['icon']['filled'] ?? null,
      'classList' => $item['icon']['classList'] ?? [],
      'attributeList' => array_merge($item['icon']['attributeList'] ?? [], [
        'style' => 'background-color:' . ($item['color'] ?? '') . ';'
      ])
    ])
    @endicon
    @if ($item['label'])
    <span 
      class="{{$baseClass}}__text" 
      style="{{isset($item['color']) ? 'color:' . $item['color'] . ';' : ''}}">
      {!! $item['label'] !!}
    </span>
    @endif
  @endlink
@else
  <!-- Hidden link: Both label and icon is missing -->
@endif