<!-- product.blade.php -->
<div class="{{ $class }}" id="{{ $id }}">
    @card()
        <div class="c-card__header">
            @typography([
                'element' => 'h2',
                'variant' => 'h3',
                'classList' => [$baseClass . '__heading']
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
        @includeWhen($image && $image['src'], 'Product.components.image')
        <div class="c-card__body">
            @if ($meta)
                @typography([
                    'element' => 'p',
                    'variant' => 'meta',
                    'classList' => ['c-product__listing']
                ])
                    {{ $meta }}
                @endtypography
            @endif
            @if (!empty($bulletPoints))
                @listing([
                    'list' => $bulletPoints,
                    'classList' => ['c-product__listing']
                ])
                @endlisting
            @endif
        </div>
        @includeWhen($button, 'Product.components.button')
    @endcard
</div>
