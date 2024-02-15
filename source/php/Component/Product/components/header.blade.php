<div class="c-card__header {{ $baseClass }}__header">
    @typography([
        'element' => 'h2',
        'variant' => 'h3',
        'classList' => [$baseClass . '__heading', $baseClass . '__heading--' . $backgroundColor]
    ])
        {{ $heading }}
    @endtypography
    @typography([
        'element' => 'p',
        'classList' => [$baseClass . '__label']
    ])
        {{ $label }}
    @endtypography
</div>