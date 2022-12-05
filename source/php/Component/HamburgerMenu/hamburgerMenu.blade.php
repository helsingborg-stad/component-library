<!-- hamburgerMenu.blade.php -->
<nav class="{{$class}} o-grid" js-toggle-item="hamburger-menu" js-toggle-class="u-display--none" {!! $attribute !!}>
    
    {!! $slot !!}

    <ul class="{{$baseClass}}__list o-grid unlist o-grid-12">
        @foreach ($menuItems as $item)
            <li id="{{$id}}-main-item-{{$item['id']}}"
                class="{{$baseClass}}__item {{$baseClass}}__item--parent o-grid-12 o-grid-6@md o-grid-4@lg u-mb-6 u-margin__top--1 {{$item['classNames']}}">
                @if($parentStyle)
                    @button([
                        'text' => $item['label'],
                        'style' => $parentStyle,
                        'color' => 'primary',
                        'icon' => $item['icon']['icon'] !== "" ? $item['icon']['icon'] : 'chevron_right',
                        'href' => $item['href'],
                        'classList' => [
                            $baseClass . '__link',
                            $baseClass . '__link--button',
                        ]
                    ])
                    @endbutton
                @else
                    @link([
                        'href' => $item['href'],
                        'classList' => [
                            $baseClass . '__link', 
                            $baseClass . '__link--title'
                        ]
                    ])
                     @if(isset($item['icon']) && !empty($item['icon']['icon']))
                        @icon([
                            'icon' => $item['icon']['icon'],
                            'size' => $item['icon']['size'],
                            'classList' => $item['icon']['classList'],
                        ])
                        @endicon
                    @endif
                        {{ $item['label'] }}
                    @endlink
                @endif
                {{-- Children --}}
                @if (!empty($item['children']))
                    <ul class="{{$baseClass}}__sublist unlist u-margin__top--2">
                        @foreach ($item['children'] as $child)
                            <li id="{{$id}}-item-{{$child['id']}}" class="{{$baseClass}}__item {{$baseClass}}__item--child {{ $child['classNames'] }}">
                                @link([
                                    'href' => $child['href'],
                                    'classList' => [
                                        $baseClass . '__link', 
                                        $baseClass . '__link--child'
                                    ]
                                ])
                                @if(isset($child['icon']) && !empty($child['icon']['icon']))
                                    @icon([
                                        'icon' => $child['icon']['icon'],
                                        'size' => $child['icon']['size'],
                                        'classList' => $child['icon']['classList'],
                                    ])
                                    @endicon
                                @endif
                                    {{ $child['label'] }}
                                @endlink
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</nav>
