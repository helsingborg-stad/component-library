@php
$directionClass = $baseClass . '__subfooter--' . ($subfooter['flexDirection'] == 'row' ? 'horizontal' : 'vertical');
$alignmentClass = $baseClass . '__subfooter--align-' . $subfooter['alignment'] ?? 'flex-start';
@endphp

<div class="{{$baseClass}}__subfooter {{$directionClass}} {{$alignmentClass}}">
    <div class="o-container">
        <div class="{{$baseClass}}__subfooter__wrapper">
            @if($subfooterLogotype)
                <div class="{{$baseClass}}__subfooter__logotype-wrapper">
                    @logotype([
                        'id' => 'footer-subfooter-logotype',
                        'src'=> $subfooterLogotype,
                        'alt' => __('Go to homepage', 'component-library'),
                        'classList' => [$baseClass . '__subfooter__logotype']
                    ])
                    @endlogotype
                </div>
            @endif
            <ul class="{{$baseClass}}__subfooter__list">
                @foreach($subfooter['content'] as $index => $item)
                    <li>
                        <strong>{{ $item['title'] }}</strong>
                        @if($item['link'])
                            @link([
                                'href' => $item['link']
                            ])
                                {{ $item['content'] }}
                            @endlink
                        @else
                            {{ $item['content'] }}
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>