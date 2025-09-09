@if($item['children'])
    @element([
        'classList' => [
            $baseClass . '__extended-dropdown-container',
        ]
    ])
        @element([
            'classList' => [
                $baseClass . '__extended-dropdown-content-area'
            ]
        ])
            @element([
                'classList' => [
                    $baseClass . '__extended-content',
                ],
                'attributeList' => [
                    'data-js-extended-dropdown-content' => true
                ]
            ])
                @typography([
                    'classList' => [
                        $baseClass . '__extended-dropdown-title',
                    ],
                    'attributeList' => [
                        'data-js-extended-dropdown-title' => true
                    ],
                    'element' => 'h2'
                ])
                    {{ $item['label'] }}
                @endtypography
                @if (is_array($item['children']))
                    @nav([
                        'items' => $item['children'],
                        'includeToggle' => $includeToggle,
                        'depth' =>  $depth ? $depth + 1 : 2,
                        'direction' => 'vertical',
                        'height' => 'sm',
                        'classList' => [
                            $baseClass . '--bordered',
                            $baseClass . '__extended-child-menu'
                        ],
                        'attributeList' => [
                            'data-js-extended-dropdown-child-menu' => true
                        ],
                        'expandIcon' => $expandIcon,
                    ])
                    @endnav
                @else
                    <div data-js-async-children="true"></div>
                @endif

            @endelement
        @endelement
    @endelement
@endif