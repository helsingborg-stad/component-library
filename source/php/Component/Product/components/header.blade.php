<div class="c-card__header c-product__header">
    @typography([
        'element' => 'h2',
        'variant' => 'h3',
        'classList' => [$baseClass . '__heading', $baseClass . '__heading--' . $backgroundColor]
    ])
        {{ $heading }}
    @endtypography
    @typography([
        'element' => 'p',
        'variant' => 'p',
        'classList' => ['c-product__label']
    ])
        {{ $label }}
    @endtypography
</div>