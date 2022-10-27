<{{ $componentElement }} 
    @if($isLink)
        href="{{ $href }}" 
    @endif
    class="{{ $class }}"
    {!! $attribute !!}
    >
    {{$beforeContent}} {{ $slot }} {{$afterContent}}
</{{ $componentElement }}>
