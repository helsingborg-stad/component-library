<!-- datebadge.blade.php -->
<div class="{{ $class }}" {!! $attribute !!}>
    @typography(['element' => 'span', 'classList' => [$baseClass . '__month']])
        {{ $month }}
    @endtypography
    @typography(['element' => 'span', 'classList' => [$baseClass . '__date']])
        {{ $day }}
    @endtypography
</div>