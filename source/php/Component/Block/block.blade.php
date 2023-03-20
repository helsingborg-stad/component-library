<!-- block.blade.php -->
<{{ $componentElement }} class="{{ $class }}"
    @if ($image && isset($image['src'])) style="background-image:url('{{ $image['src'] }}');" @endif{!! $attribute !!}>

    @if ($date && $dateBadge)
        @datebadge(['date' => $date, 'classList' => ['u-position--absolute', 'u-margin--3', 'u-fixed--top-left']])
        @enddatebadge
    @endif

    @if (!$slotHasData)
        <div class="{{ $baseClass }}__body">

            @if ($date && !$dateBadge)
                @date([
                    'action' => false,
                    'timestamp' => $date,
                    'classList' => [$baseClass . '__date']
                ])
                @enddate
            @endif

            @if ($meta)
                @if (is_string($meta))
                    @typography(['variant' => 'meta', 'element' => 'span', 'classList' => [$baseClass . '__meta']])
                        {{ $meta }}
                    @endtypography
                @elseif(is_array($meta))
                    @tags([
                        'tags' => $meta,
                        'beforeLabel' => '',
                        'format' => false,
                        'classList' => [$baseClass . '__meta']
                    ])
                    @endtags
                @endif
            @endif
            @if ($secondaryMeta)
                @if (is_string($secondaryMeta))
                    @typography(['variant' => 'secondarymeta', 'element' => 'span', 'classList' => [$baseClass . '__secondarymeta']])
                        {{ $secondaryMeta }}
                    @endtypography
                @elseif(is_array($secondaryMeta))
                    @tags([
                        'tags' => $secondaryMeta,
                        'beforeLabel' => '',
                        'format' => false,
                        'classList' => [$baseClass . '__secondarymeta']
                    ])
                    @endtags
                @endif
            @endif

            @if ($heading || $icon)
            @group([
                'justifyContent' => 'space-between'
                'alignItems' => 'start',
            ])
                @if ($heading)
                    @typography([
                        'element' => 'h2',
                        'variant' => 'h2',
                        'classList' => [$baseClass . '__heading']
                    ])
                        {!! $heading !!}
                    @endtypography
                @endif
                @if ($icon)
                    @icon($icon)
                    @endicon
                @endif
            @endgroup
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
