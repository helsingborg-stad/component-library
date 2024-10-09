<!-- segment.blade.php -->
<section class="{{ $class }}" {!! $attribute !!}>
    @if($floatingSlotHasData)
        <div class="{{$baseClass}}__floating">
            {!! $floating !!}
        </div>
    @endif
    @includeWhen(
        $hasImage && $hasPlaceholder, 
        'Segment.components.image'
    )
    @include('Segment.partials.' . $layout)
</section>
