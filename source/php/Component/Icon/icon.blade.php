<!-- icon.blade.php -->
@if ($icon)
    <{{ $componentElement }} class="{{ $class }}" {!! $attribute !!}>
        @includeWhen(!empty($svgFromLink), 'Icon.partials.svgImage')
        @includeWhen(!empty($svgElementFromFile), 'Icon.partials.svgElement')
    </{{ $componentElement }}>
@endif
