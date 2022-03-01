@typography(['variant' => 'meta', 'element' => 'span'])
    @if(is_array($meta))
        @if(array_filter($meta, 'is_string') !== [])
            {{ implode(', ', $meta) }}
        @else
            @foreach($meta as $value)
                @if(isset($value['href']) && !empty($value['href']))
                    @link(['href' => $value['href']])
                        {!! $value['label'] !!}
                    @endlink
                @else
                    {!! $value['label'] !!}
                @endif
            @endforeach
        @endif
    @else
        {!! $meta !!}
    @endif
@endtypography
