<!-- block.blade.php -->
<{{ $componentElement }} href="{{ $link }}" id="{{ $id }}" class="{{$class}}" {!! $attribute !!}>
    @if(!$slotHasData)
        <div class="{{$baseClass}}__body">

            @if($date)
                @typography(['variant' => 'meta', 'element' => 'span', 'classList' => [$baseClass."__date"]])
                    {{ $date }}
                @endtypography
            @endif

            @if($meta)
                @typography(['variant' => 'meta', 'element' => 'span', 'classList' => [$baseClass."__meta"]])
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
            @endif

            @if($heading)
                @typography([
                    'element'   => 'h2',
                    'variant'   => 'h2',
                    'classList' => [
                        $baseClass."__heading"
                    ]
                ])
                    {!! $heading !!}
                @endtypography
            @endif

        </div>
    @endif
    {!! $slot !!}
</{{ $componentElement }}>
