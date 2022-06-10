@foreach($prices as $price)
    <div class="{{ $baseClass }}__price {{ $baseClass }}__price--{{ $price['backgroundColor'] ?? 'primary' }}">
        @typography([
            'element' => 'span',
            'variant' => 'title',
            'classList' => [
                $baseClass . '__amount'
            ]
        ])
            {{ $price['amount'] }}
        @endtypography
        @if(!empty($price['currency']))
            @typography([
                'element' => 'span',
                'variant' => 'subtitle',
                'classList' => [
                    $baseClass . '__currency'
                ]
            ])
                {{ $price['currency'] }}
            @endtypography
        @endif
        @if(!empty($price['frequency']))
            @typography([
                'element' => 'span',
                'variant' => 'meta',
                'classList' => [
                    $baseClass . '__frequency'
                ]
            ])
                /{{ $price['frequency'] }}
            @endtypography
        @endif
    </div>
@endforeach