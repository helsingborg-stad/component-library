<!-- drawer.blade.php -->
@if($toggleButtonData)
    @button($toggleButtonData)@endbutton
@endif

<nav class="c-drawer c-drawer--right c-drawer--primary js-drawer {{$class}}" {!! $attribute !!}>
    <div class="c-drawer__header">
        
        @button([
            'style' => 'basic',
            'icon' => 'close',
            'attributeList' => [
                'aria-controls' => 'navigation',
                'data-simulate-click' => $simulateClickSelector
            ],
            'classList' => [
                'c-drawer__close',
                's-drawer__close-button'
            ],
            'size' => 'md',
            'text' => $label,
            'context' => 'drawer.closeButton'
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
