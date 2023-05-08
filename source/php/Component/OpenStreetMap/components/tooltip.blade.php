<div class="c-openstreetmap__tooltip">
@typography([
    'classList' => ['c-openstreetmap__tooltip-title'],
    'element' => 'h2',
    'variant' => 'h5',
])
    {TOOLTIP_HEADING}
@endtypography
@typography([
    'classList' => ['u-margin__top--1', 'c-openstreetmap__tooltip-excerpt'],
    
])
    {TOOLTIP_EXCERPT}
@endtypography
@image([
'classList' => ['c-openstreetmap__tooltip-image', 'u-margin__top--2'],
'src' => '{TOOLTIP_IMAGE_SRC}',
'alt' => '{TOOLTIP_IMAGE_ALT}',
])
@endimage
@link([
'href' => '{TOOLTIP_DIRECTIONS_URL}',
'classList' => ['u-margin__top--2', 'c-openstreetmap__tooltip-directions']
])
{TOOLTIP_DIRECTIONS_LABEL}
@endlink
</div>
