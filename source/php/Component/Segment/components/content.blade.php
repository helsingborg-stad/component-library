@if ($title || $icon || $meta)
    @group([
        'justifyContent' => $icon ? 'space-between' : 
        ($textAlignment == 'center' ? 'center' : 
        ($textAlignment == 'right' ? 'flex-end' : 
        'space-between')),
        'alignItems' => 'start',
        'gap' => 2
    ])
        @group([
            'direction' => 'vertical',
            'classList' => ['u-width--100']
        ])
            @if ($title)
                @typography([
                    'element' => 'h2',
                    'variant' => $layout == 'full-width' ? 'h1' : ($layout == 'card' ? 'h3' : 'h2'),
                    'classList' => [$baseClass . '__title', 'u-margin__bottom--1', 'u-margin__top--0'],
                    'autopromote' => true
                ])
                    @link([
                        'href' => $link,
                        'keepContent' => true,
                        'keepWrapper' => false
                    ])
                        {!! $title !!}
                    @endlink
                @endtypography
            @endif

            @if ($meta)
                @typography([
                    'element' => 'span',
                    'variant' => 'h4',
                    'classList' => [$baseClass . '__meta']
                ])
                    {!! $meta !!}
                @endtypography
            @endif
        @endgroup

        @if ($icon)
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

@if ($date)
    @date([
        'action' => false,
        'classList' => [$baseClass . '__date'],
        ...$date
    ])
    @enddate
@endif

@if ($tags)
    @tags([
        'tags' => $tags,
        'classList' => [$baseClass . '__tags', 'u-margin__top--1']
    ])
    @endtags
@endif

@if ($aboveContentSlotHasData)
    @element([
        'classList' => [$baseClass . '__above-content', 'u-margin__top--1']
    ])
        {!! $aboveContent !!}
    @endelement
@endif

@if ($content)
    @typography([
        'element' => 'div',
        'classList' => [$baseClass . '__text']
    ])
        {!! $content !!}
    @endtypography
@endif

@if ($belowContentSlotHasData)
    @element([
        'classList' => [$baseClass . '__below-content', 'u-margin__top--1']
    ])
        {!! $belowContent !!}
    @endelement
@endif

@if ($buttons)
    <div class="{{ $baseClass }}__buttons">
        @foreach ($buttons as $button)
            @if (!empty($button['href']))
                @button($button)
                @endbutton
            @endif
        @endforeach
    </div>
@endif
