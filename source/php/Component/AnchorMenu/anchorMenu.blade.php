<!-- anchorMenu.blade.php -->
@if(!empty($menuItems) && count($menuItems) > 1)
    <div class="{{$class}}" id="scroll-spy" {!! $attribute !!}>
        @group([
            'wrap' => 'wrap',
            'classList' => ['scroll-spy__container']
        ])
        @foreach($menuItems as $item)
            @link([
                'href' => $item['anchor'],
                'classList' => ['scroll-spy__item']
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