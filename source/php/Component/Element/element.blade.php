@if ($slotHasData || !$hideIfNoContent)
    <{{ $componentElement }} class="{{ $class }}" {!! $attribute !!}>
        {{ $slot }}
    </{{ $componentElement }}>
@endif
@dump($componentController->getSlug())
