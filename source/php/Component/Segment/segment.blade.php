<!-- segment.blade.php -->
<section class="{{ $class }}" {!! $attribute !!}>
    @includeWhen($image, 'Segment.components.image')
    @include('Segment.partials.' . $layout)
</section>
