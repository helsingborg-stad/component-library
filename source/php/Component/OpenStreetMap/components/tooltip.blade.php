@group([
    'direction' => 'vertical',
])
@typography([
    'element' => 'h2',
    'variant' => 'h5',
])
    {TOOLTIP_HEADING}
@endtypography
@link([
    'href' => '{TOOLTIP_DIRECTIONS_URL}',
    'classList' => ['u-margin__top--1']
])
    {TOOLTIP_DIRECTIONS_LABEL}
@endlink
@endgroup