<!-- datebadge.blade.php -->
<div id="{{ $id }}" class="{{ $class }}" {!! $attribute !!}>
    @typography(['variant' => 'h1', 'element' => 'span', 'classList' => [$baseClass . '__date']])
        {{ $day }}
    @endtypography
    @typography(['variant' => 'h4', 'element' => 'span', 'classList' => [$baseClass . '__month']])
        {{ $month }}
    @endtypography
</div>