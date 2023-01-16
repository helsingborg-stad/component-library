@if(!empty($menuItems) && count($menuItems) > 1)
    <div class="o-container u-position--sticky u-level-5 u-margin__bottom--2 u-margin__top--3" id="scroll-spy">
        @group([
            'wrap' => 'wrap',
            'classList' => ['scroll-spy__container']
        ])
        @foreach($menuItems as $item)
            @link([
                'href' => $item['anchor'],
                'classList' => ['scroll-spy__item', 'u-color__text--dark']
            ])
                @if($item['icon'] && !empty($item['icon']))
                    @icon([
                        'icon' => $item['icon'],
                        'size' => 'md',
                    ])
                    @endicon
                @endif
                {{$item['label']}}
            @endlink
        @endforeach
        @endgroup
    </div>
@endif