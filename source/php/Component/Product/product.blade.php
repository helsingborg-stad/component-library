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
                ])
                @endlisting
            @endif
        </div>
        <div class="c-card__footer {{$baseClass}}__footer">
                @includeWhen($prices, 'Product.components.price')
                @includeWhen(!empty($button), 'Product.components.button')
        </div>
    @endcard
</div>
