@if (!empty($item['icon']))
    @if (!empty($item['icon']['type']) && $item['icon']['type'] === 'svg')
        @image([
            'src' => $item['icon']['src'],
            'alt' => $item['icon']['alt'] ?? ''
        ])
        @endimage
    @else
        @icon([
            'icon' => $item['icon']['src'],
            'size' => $item['size'] ?? 'md'
        ])
        @endicon
    @endif
@endif
