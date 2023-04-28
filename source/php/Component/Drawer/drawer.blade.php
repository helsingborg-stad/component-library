<!-- drawer.blade.php -->
@if($toggleButtonData)
    @button($toggleButtonData)@endbutton
@endif

<nav class="c-drawer c-drawer--right c-drawer--primary js-drawer {{$class}}" js-toggle-class="is-open" js-toggle-item="js-drawer" {!! $attribute !!}>
   
    @if($toggleButtonData || $searchSlotHasData) 
        <div class="c-drawer__header">
            @if($toggleButtonData)
                @button([
                    'style' => 'basic',
                    'icon' => 'close',
                    'attributeList' => [
                        'aria-controls' => 'navigation',
                        'data-simulate-click' => '#' . $toggleButtonData['id'] ?? 'drawer-close'
                    ],
                    'classList' => [
                        'c-drawer__close'
                    ],
                    'size' => 'md',
                    'text' => $label
                ])
                @endbutton
            @endif
        
            @if($searchSlotHasData)
                {!! $search !!}
            @endif
        </div>

    @endif

    <div class="c-drawer__body">  
        {{-- Placed in another file, due to ajax loading --}}

        @if($menuSlotHasData)
            {!! $menu !!}
        @endif

    </div>
</nav>
<div class="drawer-overlay js-close-drawer {{$screenSizeClassNames}}" js-toggle-trigger="js-drawer"></div>
