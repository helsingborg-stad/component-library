<{{$listItem}} class="{{$baseClass}}__item u-display--none@xs">  
    @icon([
        'icon' => 'more_horiz',
        'size' => $buttonSize
    ])
    @endicon
</{{$listItem}}>

<{{$listItem}} class="{{$baseClass}}__item u-display--none@xs">
    @button([
        'style' => $buttonStyle,
        'size' => $buttonSize,
        'color' => 'default',
        'href' => $lastItem['href'],
        'classList' => [
            $baseClass . '__link'
        ],
        'text' => ($lastItem['key'] +1),
        'attributeList' => [
            'aria-label' => $lastItem['label']
        ]
    ])
    @endbutton
</{{$listItem}}>