<div class="{{$baseClass}}__prices {{!empty($button) ? 'has-button' : ''}}">
@foreach ($prices as $price)
    <div class="{{ $baseClass }}__price {{ $baseClass }}__price--{{ $price['color'] ?? $backgroundColor ?? 'primary' }}">
        @typography([
            'element' => 'span',
            'variant' => 'marketing',
            'classList' => [$baseClass . '__amount']
        ])
            {{ $price['amount'] }}
        @endtypography
        @if (!empty($price['currency']))
            @typography([
                'element' => 'span',
                'variant' => 'marketing',
                'classList' => [$baseClass . '__currency']
            ])
                {{ $price['currency'] }}
            @endtypography
        @endif
        @if (!empty($price['frequency']))
            @typography([
                'element' => 'span',
                'variant' => 'subtitle',
                'classList' => [$baseClass . '__frequency']
            ])
                <span class="{{ $baseClass . '__seperator' }}">/</span>
                {{ $price['frequency'] }}
            @endtypography
        @endif
    </div>
@endforeach
</div>
