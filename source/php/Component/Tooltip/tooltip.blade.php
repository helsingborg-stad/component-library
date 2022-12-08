{{-- <{{ $componentElement }} 
    @if($isLink)
        href="{{ $href }}" 
    @endif
    class="{{ $class }}"
    {!! $attribute !!}
    >
    {{$beforeContent}} {{ $slot }} {{$afterContent}}
</{{ $componentElement }}> --}}

<div class="{{$class}}">
    @if($label) {
        {{$label}}
    }
    @endif
    @if($icon)
        @icon([
            'icon' => 'arrow_circle_up',
            'size' => 'md',
        ])
        @endicon
    @endif
    <div class="{{$baseClass}}__container" style="background-color: {{$backgroundColor}}; color:{{$backgroundColor}}; width:{{$width}}">
        <div class="{{$baseClass}}__content" style="color: {{$color}}">TJA! TJA! TJA! TJA!TJA! TJA!TJA! TJA!TJA!TJA!TJA!TJA!TJA!</div>
        <span class="{{$baseClass}}__arrow"></span>
    </div>

</div>