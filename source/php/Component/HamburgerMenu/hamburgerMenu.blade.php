<!-- hamburgerMenu.blade.php -->
<nav id="{{$id}}" class="{{$class}} o-grid" js-toggle-item="hamburger-menu" js-toggle-class="u-display--none">
    
    {!! $slot !!}

    <ul class="{{$baseClass}}__list o-grid unlist o-grid-12">
        @foreach ($menuItems as $item)
            <li id="{{$id}}-item-{{$item['id']}}"
                class="{{$baseClass}}__item {{$baseClass}}__item--parent o-grid-12 o-grid-6@md o-grid-4@lg u-mb-6 u-margin__top--1 {{$item['classNames']}}">
                @if($parentStyle)
                    @button([
                        'text' => $item['label'],
                        'style' => $parentStyle,
                        'color' => 'primary',
                        'icon' => 'chevron_right',
                        'href' => $item['href'],
                        'classList' => [
                            $baseClass . '__link',
                            $baseClass . '__link--button',
                        ]
                    ])
                    @endbutton
                @else
                    <a href="{{$item['href']}}" class="{{$baseClass}}__link {{$baseClass}}__link--title">{{$item['label']}}</a>
                @endif
                {{-- Children --}}
                @if (!empty($item['children']))
                    <ul class="{{$baseClass}}__sublist unlist u-margin__top--2">
                        @foreach ($item['children'] as $child)
                            <li id="{{$id}}-item-{{$item['id']}}"
                                class="{{$baseClass}}__item {{$baseClass}}__item--child {{ $child['classNames'] }}">
                                <a href="{{ $child['href'] }}">{{ $child['label'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</nav>
