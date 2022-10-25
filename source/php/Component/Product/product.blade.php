<!-- product.blade.php -->
<div class="{{ $class }}" {!! $attribute !!}>
    @card()
        @includeWhen($image && $image['src'], 'Product.components.image')
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
            @includeWhen($prices, 'Product.components.price')
        </div>
        <div class="c-card__body c-product__body">
            @if ($meta)
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
                    'icon' => [
                        'icon' => '',
                        'size' => ''
                    ]
                ])
                @endlisting
            @endif
        </div>
        @includeWhen($button, 'Product.components.button')
    @endcard
</div>
