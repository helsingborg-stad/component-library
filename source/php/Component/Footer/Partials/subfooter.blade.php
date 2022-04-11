@php
$directionClass = $baseClass . '__subfooter--' . ($subfooter['direction'] ?? 'horizontal');
$alignmentClass = $baseClass . '__subfooter--align-' . $subfooter['alignment'] ?? 'flex-start';
@endphp

<div class="{{$baseClass}}__subfooter {{$directionClass}} {{$alignmentClass}}">
    <div class="o-container">
        <div class="{{$baseClass}}__subfooter__wrapper">
            @if($subfooterLogotype->url)
                <div class="{{$baseClass}}__subfooter__logotype-wrapper">
                    @link(['href' => $homeUrl, 'classList' => ['u-margin__right--auto']])
                        @logotype([
                            'id' => 'footer-logotype',
                            'src'=> $subfooterLogotype->url,
                            'alt' => $lang->goToHomepage,
                            'classList' => ['site-footer__logo', $baseClass . '__subfooter__logotype']
                        ])
                        @endlogotype
                    @endlink
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