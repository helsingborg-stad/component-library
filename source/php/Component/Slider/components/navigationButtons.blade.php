<div class="c-slider__arrows" id="{{$id}}">
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
            'aria-controls' => $id . '__track',
            'aria-label' => 'Previous slide',
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
            'aria-controls' => $id . '__track',
            'aria-label' => 'Next slide',
        ]
    ])
    @endbutton
</div>
