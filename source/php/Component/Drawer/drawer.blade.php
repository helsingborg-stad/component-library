<!-- drawer.blade.php -->
@if($toggleButtonData)
    @button($toggleButtonData)
    @endbutton
@endif

<nav class="c-drawer c-drawer--right js-drawer {{$class}}" {!! $attribute !!}>
    <div class="c-drawer__header">
        @button([
            'style' => 'basic',
            'icon' => 'close',
            'attributeList' => [
                'aria-controls' => 'drawer',
                'data-simulate-click' => $simulateClickSelector
            ],
            'classList' => [
                'c-drawer__close',
            ],
            'size' => 'md',
            'text' => $label,
        ])
        @endbutton
    
        @if($searchSlotHasData)
            {!! $search !!}
        @endif
    </div>

    <div class="c-drawer__body">  
        {{-- Placed in another file, due to ajax loading --}}

        @if($menuSlotHasData)
            {!! $menu !!}
        @endif

    </div>
</nav>

<div class="drawer-overlay js-close-drawer {{$screenSizeClassNames}}" data-simulate-click="{{$simulateClickSelector}}" {!! $moveTo !!}></div>
