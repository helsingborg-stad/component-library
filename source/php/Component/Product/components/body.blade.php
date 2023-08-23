<div class="c-card__body {{ $baseClass }}__body">
    @if (!empty($meta))
        @typography([
            'element' => 'p',
            'variant' => 'meta',
            'classList' => [$baseClass . '__meta']
        ])
            {{ $meta }}
        @endtypography
    @endif
    @if (!empty($bulletPoints))
        @listing([
            'list' => $bulletPoints,
            'classList' => [$baseClass . '__listing', $baseClass . '__listing--' . $backgroundColor],
        ])
        @endlisting
    @endif
</div>