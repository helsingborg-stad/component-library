<!-- product.blade.php -->
<div class="{{$class}}" id="{{ $id }}">
    @card()
        <div class="c-card__header">
            @typography([
                'element'   => 'h2',
                'variant'   => 'h3',
                'classList' => [
                    $baseClass . '__heading'
                ]
            ])
                {{ $heading }}
            @endtypography
            @typography()
                {{ $label }}
            @endtypography
            @includeWhen($prices, 'Product.components.price')
        </div>
        @includeWhen($image && $image['src'], 'Product.components.image')
        <div class="c-card__body">
            @if($meta)
                @typography()
                    {{ $meta }}
                @endtypography
            @endif
            @listing([
                'list' => $bulletPoints
            ])
            @endlisting
        </div>
        @includeWhen($button, 'Product.components.button')
    @endcard
</div>
