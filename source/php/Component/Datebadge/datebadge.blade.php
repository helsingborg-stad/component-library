<!-- datebadge.blade.php -->
<div class="{{ $class }}" {!! $attribute !!}>
    @element([
        'classList' => [
            $baseClass . '__container'
        ]
    ])
        @typography(['element' => 'span', 'classList' => [$baseClass . '__month']])
            {{ $month }}
        @endtypography
        @typography(['element' => 'span', 'classList' => [$baseClass . '__date']])
            {{ $day }}
        @endtypography
    @endelement
</div>