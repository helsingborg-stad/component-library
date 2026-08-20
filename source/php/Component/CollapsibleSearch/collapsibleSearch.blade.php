{{-- collapsible-search.blade.php --}}
<div class="{{ $class }}" {!! $attribute !!}>

    {{-- Trigger button: visible in closed state, hidden when expanded --}}
    @button($button)
    @endbutton

    {{-- Search panel: hidden in closed state, visible when expanded --}}
    <form
        class="{{ $baseClass }}__panel"
        id="{{ $uid }}-panel"
        role="search"
        method="{{ $method }}"
        @if ($action) action="{{ $action }}" @endif
        aria-hidden="{{ $isExpanded ? 'false' : 'true' }}"
        @if (!$isExpanded) inert @endif
    >
        <label
            class="{{ $baseClass }}__label u-visually-hidden"
            for="{{ $uid }}-input"
        >{{ $inputLabel }}</label>

        <input
            class="{{ $baseClass }}__input"
            id="{{ $uid }}-input"
            type="search"
            name="{{ $inputName }}"
            placeholder="{{ $placeholder }}"
            autocomplete="off"
            data-js-collapsible-search-input
        />

        {{-- Submit search --}}
        @button([
            'icon'             => 'search',
            'style'            => 'basic',
            'color'            => 'default',
            'size'             => $size ?? 'md',
            'type'             => 'submit',
            'componentElement' => 'button',
            'ariaLabel'        => $lang['submitLabel'] ?? 'Search',
            'classList'        => [$baseClass . '__submit'],
            'attributeList'    => ['data-js-collapsible-search-submit' => ''],
        ])
        @endbutton

        {{-- Close / collapse --}}
        @button([
            'icon'             => 'close',
            'style'            => 'basic',
            'color'            => 'default',
            'size'             => $size ?? 'md',
            'type'             => 'button',
            'componentElement' => 'button',
            'ariaLabel'        => $closeLabel,
            'classList'        => [$baseClass . '__close'],
            'attributeList'    => [
                'data-js-collapsible-search-close' => '',
                'aria-controls'                    => $uid . '-panel',
            ],
        ])
        @endbutton
    </form>

</div>
