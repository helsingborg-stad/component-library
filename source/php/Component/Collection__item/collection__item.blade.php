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

    @if($action) 
        
        <div class="c-collection__secondary">
            @button([
                'href'  => $action['link'],
                'icon'  => $action['icon'],
                'style' => $action['style'] ? $action['style'] : 'basic',
                'text'  => $action['text'],
                'color' => $action['color'] ? $action['color'] : 'default',
                'target' => $action['target'] ? $action['target'] : '_top',
            ])
            @endbutton

        </div>
    @endif
</{{$componentElement}}>