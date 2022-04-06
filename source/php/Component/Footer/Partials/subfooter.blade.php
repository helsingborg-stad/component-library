<div class="{{ $baseClass }}__subfooter {{$subfooterClass}}">
    <div class="o-container">
        <div class="{{$baseClass}}__subfooter__wrapper">
            @if($subfooterLogotype->url)
                <div class="{{$baseClass}}__subfooter__logotype">
                    @link(['href' => $homeUrl, 'classList' => ['u-margin__right--auto']])
                        @logotype([
                            'id' => 'footer-logotype',
                            'src'=> $subfooterLogotype->url,
                            'alt' => $lang->goToHomepage,
                            'classList' => ['site-footer__logo', 'c-footer__logotype']
                        ])
                        @endlogotype
                    @endlink
                </div>
            @endif
            <ul class="{{$baseClass}}__subfooter__list">
                @foreach($subFooterContent as $index => $item)
                    <li>
                        <strong>{{ $item['title'] }}</strong>
                        @if($item['link'])
                            @link([
                                'href' => $item['link'],
                                'target' => $item['openNewTab'] ? '_blank' : '_top'
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