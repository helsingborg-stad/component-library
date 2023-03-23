<!-- block.blade.php -->
<{{ $componentElement }} class="{{ $class }}" {!! $attribute !!}>

    @if ($date && $dateBadge)
        @datebadge(['date' => $date, 'classList' => ['u-position--absolute', 'u-margin--3', 'u-fixed--top-left']])
        @enddatebadge
    @endif

    @if (!$slotHasData)
        <div class="{{ $baseClass }}__body">

            @if ($image)
                @image(array_merge($image, ['classList' => [$baseClass . '__image']]))
                @endimage
            @endif

            @if ($icon)
                @icon([
                    'icon' => $icon['name'],
                    'classList' => [$baseClass . '__icon']
                ])
                @endicon
            @endif

            @if ($date && !$dateBadge)
                @tags([
                    'tags' => [['label' => $date]],
                    'beforeLabel' => '',
                    'format' => false,
                    'classList' => [$baseClass . '__tags']
                ])
                @endtags
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
                    'variant' => 'p',
                    'classList' => [$baseClass . '__content']
                ])
                    {!! $content !!}
                @endtypography
            @endif

        </div>
    @endif
    {!! $slot !!}
    </{{ $componentElement }}>
