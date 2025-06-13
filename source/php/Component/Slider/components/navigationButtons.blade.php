<div class="c-slider__arrows" id="slider_{{$id}}">
    @button([
        'color' => $arrowButtons['color'],
        'icon' => 'keyboard_arrow_left',
        'style' => $arrowButtons['style'],
        'classList' => [
            'c-slider__arrow',
            'c-slider__arrow--prev'
        ],
        'attributeList' => [
            'data-js-slider-prev' => true,
        ]
    ])
    @endbutton
    @button([
        'color' => $arrowButtons['color'],
        'icon' => 'keyboard_arrow_right',
        'style' => $arrowButtons['style'],
        'classList' => [
            'c-slider__arrow',
            'c-slider__arrow--next'
        ],
        'attributeList' => [
            'data-js-slider-next' => true,
        ]
    ])
    @endbutton
</div>