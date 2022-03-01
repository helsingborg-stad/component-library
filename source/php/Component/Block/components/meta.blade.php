@typography(['variant' => 'meta', 'element' => 'span'])
    @if (is_array($meta))
        @if (array_filter($meta, 'is_string') !== [])
            {{ implode(', ', $meta) }}
        @else
            @foreach ($meta as $value)
                {!! $value['label'] !!}
                {{ !$loop->last ? ', ' : '' }}
            @endforeach
        @endif
    @else
        {!! $meta !!}
    @endif
@endtypography
