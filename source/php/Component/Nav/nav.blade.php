<!-- nav.blade.php -->
@if ($items) 
    <ul class="{{$class}}" {!! $attribute !!}>
        @foreach ($items as $item)
            <li 
                id="{{$id}}-{{$item['id']}}-{{$loop->index}}__item" 
                class="{{$baseClass}}__item {{$baseClass}}__item--{{$item['style']}} {{$item['active'] ? 'is-current' : ''}}{{$item['active'] && $item['children'] || $item['ancestor'] ? ' is-open has-fetched' : ''}} {{!$item['active'] && is_array($item['children']) ? ' has-fetched' : ''}}"
                depth="{{$depth}}"
                {{-- Append dynamic attributes --}}
                {!! !empty($item['attributeList']) ? $buildAttributes($item['attributeList']) : '' !!}
            >

                @if($allowStyle && !empty($item['style']) && $item['style'] == 'button')
                    @button([
                        'id' => $id . " - " . $item['id'] ."-" . $loop->index . "__label",
                        'icon' => isset($item['icon']['icon']) ? $item['icon']['icon'] : false,
                        'reversePositions' => true,
                        'text' => $item['label'],
                        'style' => 'filled',
                        'color' => 'primary',
                        'href' => $item['href'],
                        'classList' => [
                            $baseClass . '__button',
                        ],
                        'attributeList' => [
                            'aria-label' => $item['label']
                        ]
                    ])
                    @endbutton
                @else
                    <a  id="{{$id}}-{{$item['id']}}-{{$loop->index}}__label"
                        class="{{$baseClass}}__link {{$item['class']}}" 
                        href="{{$item['href']}}" 
                        @if($item['label']) aria-label="{{$item['label']}}" @endif
                    >
                        @if(isset($item['icon']))
                            @icon($item['icon'])
                            @endicon
                        @endif
                        @if($item['label'])
                            <span class="{{$baseClass}}__text">{{$item['label']}}</span>
                            @if($item['children'])
                            <template>
                            @icon([
                                'icon' => 'expand_more',
                                'classList' => ['u-margin__left--auto']
                            ])
                            @endicon
                            </template>
                            @endif
                        @endif
                    </a>
                @endif
                
                @if (!empty($item['children']))
                    @if($includeToggle)
                        @button([
                            'classList' => [ $baseClass . '__toggle', 'js-toggle-children'],
                            'style' => 'basic',
                            'icon' => 'expand_more',
                            'size' => 'md',
                            'pressed' =>  $item['active'] ? 'true' : 'false',
                        ])
                            @loader(['size' => 'sm'])
                            @endloader
                        @endbutton
                    @endif

                    @if(is_array($item['children'])) 
                        @nav([
                            'items' => $item['children'],
                            'isExpanded' => (boolval($item['active']) || boolval($item['ancestor']) ) ? true : false,
                            'includeToggle' => $includeToggle,
                            'depth' =>  $depth + 1,
                            'direction' => $direction
                        ])
                        @endnav
                    @endif
                @endif
            </li>
        @endforeach
    </ul>
@endif