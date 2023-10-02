<!-- megaMenu.blade.php -->
<div class="{{$class}} u-display--none" js-toggle-item="mega-menu" js-toggle-class="u-display--none"  {!! $attribute !!}>
    
<nav class="{{$baseClass}}__menu o-container o-container--wide o-grid">
    
    {!! $slot !!}

    <ul class="{{$baseClass}}__list o-grid unlist o-grid-12">
        @foreach ($menuItems as $item)
            <li id="{{$id}}-main-item-{{$item['id']}}"
                class="{{$baseClass}}__item {{$baseClass}}__item--parent o-grid-12 o-grid-6@md o-grid-4@lg o-grid-3@xl u-mb-6 u-margin__top--1 {{$item['classNames']}}">
                @if(!empty($parentStyle))
                    @button([
                        'text' => $item['label'],
                        'style' => $parentStyle,
                        'color' => $parentStyleColor ?? 'primary',
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
                @if (!empty($item['description']))
                    @typography([
                        'classList' => [
                            $baseClass . '__description',
                        ]
                    ])
                        {{ $item['description'] }}
                    @endtypography
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
                                @if(isset($child['icon']) && !array_diff(['icon', 'size', 'classList'], array_keys($child['icon'])))
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
</div>
