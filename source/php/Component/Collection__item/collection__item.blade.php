<!-- collection__item.blade.php -->
<{{$componentElement}} class="{{$class}}" {!!$attribute!!}>
    @if($prefix) 
        {!! $prefix !!}
    @endif

    @if($icon) 
        <div class="c-collection__icon">
            @icon(['icon' => $icon, 'size' => 'md'])
            @endicon
        </div>
    @endif

    @if($image)
        @image([
            "src" => $image,
            "alt" => $alt,
        ])
        @endimage
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