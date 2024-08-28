<{{$componentElement}} class="{{$class}}" {!! $attribute !!}>
    <div class="{{$baseClass}}__wrapper" tabindex="1" aria-describedby="{{$id}}">
    @if($label)
    @typography([
        'element' => $typographyElement,
        'classList' => ['u-margin__right--1']
    ])
        {{$label}}
    @endtypography
    @endif
    @if($icon)
        @icon([
            'icon' => $icon,
            'size' => $iconSize
        ])
        @endicon
    @endif
            <div class="{{$baseClass}}__container" aria-hidden="true" role="tooltip" id="{{$id}}">
            @if($slotHasData) 
            <div class="{{$baseClass}}__content">
                {!! $slot !!}
            </div>
            <span class="{{$baseClass}}__arrow"></span>
            @endif
        </div>
    </div>
</{{$componentElement}}>

