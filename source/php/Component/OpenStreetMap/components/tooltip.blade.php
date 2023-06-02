<div class="c-openstreetmap__tooltip">
    @link([
        'href' => '{TOOLTIP_LINK}',
        'classList' => ['c-openstreetmap__tooltip-link'],
        'attributeList' => [
            'rel' => 'nofollow'
        ]
    ])
    @typography([
        'classList' => ['c-openstreetmap__tooltip-title'],
        'element' => 'h2',
        'variant' => 'h5',
    ])
        {TOOLTIP_HEADING}
    @endtypography
    @endlink
    @typography([
        'classList' => ['u-margin__y--1', 'c-openstreetmap__tooltip-excerpt'],
        
    ])
        {TOOLTIP_EXCERPT}
    @endtypography
    @image([
        'classList' => ['c-openstreetmap__tooltip-image', 'u-margin__top--1'],
        'src' => '{TOOLTIP_IMAGE_SRC}',
        'alt' => '{TOOLTIP_IMAGE_ALT}',
        'attributeList' => [
            'rel' => 'nofollow'
        ]
    ])
    @endimage
    @link([
        'href' => '{TOOLTIP_DIRECTIONS_URL}',
        'classList' => ['c-openstreetmap__tooltip-directions'],
        'attributeList' => [
            'rel' => 'nofollow'
        ]
    ])
        {TOOLTIP_DIRECTIONS_LABEL}
    @endlink
</div>
