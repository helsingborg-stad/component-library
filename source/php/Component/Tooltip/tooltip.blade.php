<div class="{{$class}}" {!! $attribute !!}>
    @if($label)
        {{$label}}
    @endif
    @if($icon)
        @icon([
            'icon' => $icon,
            'size' => $iconSize,
        ])
        @endicon
    @endif
    <div class="{{$baseClass}}__container" style="background-color: {{$backgroundColor}}; color:{{$backgroundColor}};">
        <div class="{{$baseClass}}__content" style="color: {{$color}};">
            {!! $slot !!}
        </div>
        <span class="{{$baseClass}}__arrow"></span>
    </div>

</div>

