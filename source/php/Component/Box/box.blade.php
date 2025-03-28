<!-- block.blade.php -->
<{{ $componentElement }} class="{{ $class }}" {!! $attribute !!}>

    @if (!empty($date) && $date['timestamp'] && !empty($dateBadge))
        @datebadge(['date' => $date['timestamp'], 'classList' => ['u-position--absolute', 'u-margin--3', 'u-fixed--top-left']])
        @enddatebadge
    @endif

    @if (!$slotHasData)
        <div class="{{ $baseClass }}__body">

            @if ($image)
                @image([
                    'src' => is_array($image) ? ($image['src'] ?? null) : $image,
                    'alt' => is_array($image) ? ($image['alt'] ?? null) : null,
                    'classList' => [
                        $baseClass . '__image'
                    ]
                ])
                @endimage
            @endif

            @if ($icon)
                @icon([
                    'icon' => $icon['name'],
                    'classList' => [$baseClass . '__icon']
                ])
                @endicon
            @endif

            @if (!empty($date) && $date['timestamp'] && empty($dateBadge))
                @date($date)
                @enddate
            @endif

            @if ($meta)
                @typography(['variant' => 'meta', 'element' => 'span', 'classList' => [$baseClass . '__meta']])
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

            @if ($secondaryMeta)
                @typography(['variant' => 'secondarymeta', 'element' => 'span', 'classList' => [$baseClass . '__secondarymeta']])
                    @if (is_array($secondaryMeta))
                        @if (array_filter($secondaryMeta, 'is_string') !== [])
                            {{ implode(', ', $secondaryMeta) }}
                        @else
                            @foreach ($secondaryMeta as $value)
                                {!! $value['label'] !!}
                                {{ !$loop->last ? ', ' : '' }}
                            @endforeach
                        @endif
                    @else
                        {!! $secondaryMeta !!}
                    @endif
                @endtypography
            @endif
            
            @if ($metaAreaSlotHasData)
                {!! $metaArea !!}
            @endif

            @if ($heading)
                @typography([
                    'element' => 'h2',
                    'variant' => 'h2',
                    'classList' => [$baseClass . '__heading']
                ])
                    {!! $heading !!}
                @endtypography
            @endif

            @if ($content)
                @typography([
                    'element' => 'p',
                    'classList' => [$baseClass . '__content']
                ])
                    {!! $content !!}
                @endtypography
            @endif

        </div>
    @endif
    {!! $slot !!}
    </{{ $componentElement }}>
