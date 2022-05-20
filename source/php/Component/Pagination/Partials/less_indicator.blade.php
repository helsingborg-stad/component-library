<{{$listItem}} class="{{$baseClass}}__item u-display--none@xs">
    @button([
        'style' => $buttonStyle,
        'size' => $buttonSize,
        'color' => 'default',
        'href' => $firstItem['href'],
        'classList' => [
            $baseClass . '__link'
        ],
        'text' => ($firstItem['key'] +1),
        'attributeList' => [
            'aria-label' => $firstItem['label']
        ]
    ])
    @endbutton
</{{$listItem}}>

<{{$listItem}} class="{{$baseClass}}__item u-display--none@xs">  
    @icon([
        'icon' => 'more_horiz',
        'size' => $buttonSize
    ])
    @endicon
</{{$listItem}}>