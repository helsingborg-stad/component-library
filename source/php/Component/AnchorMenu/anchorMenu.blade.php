<!-- anchorMenu.blade.php -->
@if(!empty($menuItems) && count($menuItems) > 1)
    <div class="{{$class}}" id="scroll-spy" {!! $attribute !!}>
        @group([
            'wrap' => 'wrap',
            'classList' => [$baseClass . '__container']
        ])
        @foreach($menuItems as $item)
            @link([
                'href' => $item['anchor'],
                'classList' => [$baseClass . '__item']
            ])
                @if(!empty($item['icon']))
                    @icon([
                        'icon' => $item['icon'],
                        'size' => 'md',
                        'classList' => [$baseClass . '__icon']
                    ])
                    @endicon
                @endif
                {{$item['label']}}
            @endlink
        @endforeach
        @endgroup
    </div>
@endif