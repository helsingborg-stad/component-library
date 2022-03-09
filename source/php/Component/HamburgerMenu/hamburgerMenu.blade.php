<!-- hamburgerMenu.blade.php -->
<nav id="{{$id}}" class="{{$class}} u-padding__y--4" js-toggle-item="hamburger-menu" js-toggle-class="u-display--none">
    <div class="container">
        @if($showSearch)
            @form(['method' => 'get', 'action' => '/'])
                <label for="hamburger-menu-search" class="u-sr__only">{{ __('Search', 'component-library') }}</label>

                @group([])
                    @field([
                        'id' => 'hamburger-menu-search',
                        'type' => 'text',
                        'attributeList' => [
                            'type' => 'text',
                            'name' => 's',
                        ],
                        'placeholder' => __('What are you looking for?', 'component-library'),
                        'required' => true,
                    ])
                    @endfield
                    @button([
                        'color' => 'primary',
                        'type' => 'submit',
                        'text' => __('Search', 'component-library')
                    ])
                    @endbutton
                @endgroup
            @endform
        @endif

        <ul class="{{$baseClass}}__list o-grid unlist u-padding__top--3">
            @foreach ($menuItems as $item)
                <li id="{{$id}}-item-{{$item['id']}}"
                    class="{{$baseClass}}__item {{$baseClass}}__item--parent o-grid-12 o-grid-6@md o-grid-4@lg u-mb-6 u-margin__top--1 {{$item['classNames']}}">
                    @if($parentButtons)
                        @button([
                            'text' => $item['label'],
                            'style' => 'outlined',
                            'color' => 'primary',
                            'icon' => 'chevron_right',
                            'href' => $item['href'],
                            'classList' => [
                                '{{$baseClass}}__link',
                                '{{$baseClass}}__link--button',
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
                                    class="{{$baseClass}}__item hamburger-menu__item--child {{ $child['classNames'] }}">
                                    <a href="{{ $child['href'] }}">{{ $child['label'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</nav>
