<!-- datebadge.blade.php -->
<div id="{{ $id }}" class="{{ $class }}" {!! $attribute !!}>
    @typography(['variant' => 'h1', 'element' => 'span'])
        {{ $day }}
    @endtypography
    @typography(['variant' => 'h4', 'element' => 'span'])
        {{ $month }}
    @endtypography
</div>