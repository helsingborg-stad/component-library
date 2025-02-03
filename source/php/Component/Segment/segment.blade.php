<!-- segment.blade.php -->
<section class="{{ $class }}" {!! $attribute !!}>
    @if($floatingSlotHasData)
        <div class="{{$baseClass}}__floating">
            {!! $floating !!}
        </div>
    @endif
    @includeWhen(
        $hasImage || ($hasPlaceholder && !$hasImage), 
        'Segment.components.image'
    )
    @include('Segment.partials.' . $layout)
</section>
