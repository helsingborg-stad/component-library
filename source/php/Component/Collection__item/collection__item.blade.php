<!-- collection__item.blade.php -->
<{{$componentElement}} class="{{$class}}" {!!$attribute!!}>
    @if($prefix) 
        {!! $prefix !!}
    @endif

    @if($floatingSlotHasData)
        <div class="{{$baseClass}}__floating">
            {!! $floating !!}
        </div>
    @endif

    @if($icon) 
        <div class="c-collection__icon">
            @icon(['icon' => $icon, 'size' => 'md'])
            @endicon
        </div>
    @endif

     @if($beforeSlotHasData)
     <div class="{{$baseClass}}__before">
        {!! $before !!}
    </div>
    @endif

    @if($slotHasData)
        <div class="c-collection__content">
            {!!$slot!!}
        </div>
    @endif

    @if($secondary) 
        <div class="c-collection__secondary">
            {!! $secondary !!}
        </div>
    @endif
</{{$componentElement}}>