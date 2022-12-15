<div class="{{$class}}" {!! $attribute !!}>
    <div class="{{$baseClass}}__wrapper" tabindex="1" aria-describedby="{{$id}}">
    @if($label)
        {{$label}}
    @endif
    @if($icon)
        @icon([
            'icon' => $icon,
            'size' => $iconSize
        ])
        @endicon
    @endif
            <div class="{{$baseClass}}__container" aria-hidden="true" role="tooltip" id="{{$id}}">
            <div class="{{$baseClass}}__content">
                {!! $slot !!}
            </div>
            <span class="{{$baseClass}}__arrow"></span>
        </div>
    </div>
</div>

