<div class="{{$class}}" {!! $attribute !!}>
    <div class="{{$baseClass}}__label" tabindex="1">
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
    </div>
    <div class="{{$baseClass}}__container" aria-hidden="true" style="background-color: {{$backgroundColor}}; color:{{$backgroundColor}};">
        <div class="{{$baseClass}}__content" style="color: {{$color}};">
            {!! $slot !!}
        </div>
        <span class="{{$baseClass}}__arrow"></span>
    </div>
</div>

