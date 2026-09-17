@if($item['icon'] || $item['label'])
  @link([
    'id' => $id . '-' . $item['id'] . '-' . $loop->index . '__label',
    'classList' => [$baseClass . '__link'],
    'href' => $item['href'],
    'xfn' => $item['xfn'] ?? false
  ])
    @if (!empty($item['icon']['icon']))
      @icon([
        'icon' => $item['icon']['icon'],
        'size' => $item['icon']['size'] ?? 'inherit',
        'filled' => $item['icon']['filled'] ?? false,
        'classList' => $item['icon']['classList'] ?? [],
        'attributeList' => array_merge($item['icon']['attributeList'] ?? [], [
          'style' => 'background-color:' . ($item['color'] ?? '') . ';'
        ])
      ])
      @endicon
    @endif
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
