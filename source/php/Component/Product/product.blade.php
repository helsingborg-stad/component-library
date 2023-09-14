<!-- product.blade.php -->
<div class="{{ $class }}" {!! $attribute !!}>
    @card()
        @includeWhen(!empty($image) && !empty($image['src']), 'Product.components.image')
        @includeWhen(!empty($heading) || !empty($label), 'Product.components.header')
        @includeWhen(!empty($meta) || !empty($bulletPoints), 'Product.components.body')
        <div class="c-card__footer {{$baseClass}}__footer">
                @includeWhen(!empty($prices), 'Product.components.price')
                @includeWhen(!empty($button), 'Product.components.button')
        </div>
    @endcard
</div>
