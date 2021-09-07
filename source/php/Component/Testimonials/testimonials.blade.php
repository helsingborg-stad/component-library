<!-- testimonials.blade.php -->
@if($testimonials)
    <{{ $componentElement }} id="{{ $id }}" class="{{ $class }}" {!! $attribute !!}>
        @foreach($testimonials as $testimonial)
                @include('Testimonials.partials.item')                                                    
        @endforeach
    </{{ $componentElement }}>
@endif
