<!-- drawer.blade.php -->
<div class="c-drawer c-drawer--right c-drawer--primary js-drawer {{$class}}" js-toggle-class="is-open" js-toggle-item="js-drawer" {!! $attribute !!}>
        <div class="c-drawer__header">
            
            @button([
                'id' => 'mobile-menu-trigger-close',
                'style' => 'basic',
                'icon' => 'close',
                'attributeList' => [
                    'aria-controls' => 'navigation',
                    'js-toggle-trigger' => 'js-drawer'
                ],
                'classList' => [
                    'c-drawer__close',
                    'u-display--none@lg'
                ],
                'size' => 'md',
                'text' => $label
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
    </div>
    <div class="drawer-overlay js-close-drawer u-display--none@lg" js-toggle-trigger="js-drawer"></div>