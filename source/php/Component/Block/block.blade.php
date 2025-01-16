<!-- block.blade.php -->
<{{ $componentElement }} class="{{ $class }}" {!! $attribute !!}>
    
    @image([
        'src' => (is_array($image) && isset($image['src'])) ? $image['src'] : $image,
        'alt' => $imageAlt ?? null,
        'classList' => [$baseClass . '__image'],
        'cover' => true,
        'placeholderEnabled' => false
    ])
    @endimage

    @if($floatingSlotHasData)
    <div class="{{$baseClass}}__floating">
        {!! $floating !!}
    </div>
    @endif

    @if($date && $dateBadge)
        @datebadge(['date' => $date, 'classList' => ['u-margin--3', 'u-absolute--top-left@sm', 'u-absolute--top-left@md', 'u-absolute--top-left@lg', 'u-absolute--top-left@xl', 'u-level-1']])
        @enddatebadge
    @endif

    @if (!$slotHasData || $hasContent)
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
            @if($metaAreaSlotHasData)
                {!! $metaArea !!}
            @endif

            @if ($heading || $icon)
            @group([
                'justifyContent' => 'space-between',
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
                @if ($icon && !empty($displayIcon))
                    @element([
                        'attributeList' => [
                            'style' => 'background-color: ' . ($iconBackgroundColor ?? 'transparent') . ';',
                        ],
                        'classList' => [
                            'u-display--flex',
                            $iconBackgroundColor ? 'u-padding__x--1' : '',
                            $iconBackgroundColor ? 'u-padding__y--1' : '',
                            'u-rounded--full',
                            'u-detail-shadow-3'
                        ]
                    ])
                        @icon($icon)
                        @endicon
                    @endelement
                @endif
            @endgroup
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
