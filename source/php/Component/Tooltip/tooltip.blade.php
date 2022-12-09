<div class="{{$class}}" {!! $attribute !!}>
    @if($icon)
        @icon([
            'icon' => 'info',
            'size' => 'md',
        ])
        @endicon
    @endif
    @if($label) {
        {{$label}}
    }
    @endif
    <div class="{{$baseClass}}__container" style="background-color: {{$backgroundColor}}; color:{{$backgroundColor}};">
        <div class="{{$baseClass}}__content" style="color: {{$color}}">
            {!! $slot !!}
        </div>
        <span class="{{$baseClass}}__arrow"></span>
    </div>

</div>

