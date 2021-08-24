<!-- testimonials.blade.php -->
@if($testimonials)
    <{{ $componentElement }} id="{{ $id }}" class="grid {{ $class }}" {!! $attribute !!}>
                @foreach($testimonials as $testimonial)
                    <div class="{{ $gridClasses }}">
                        @if($loop->index % 2 === 0 ) 
                            @include('Testimonials.partials.even')                                                    
                        @else
                            @include('Testimonials.partials.odd')
                        @endif
                        <div class="{{ $baseClass }}__quote">
                            @typography([
                                "variant" => "p",
                                "element" => "p",
                                "classList" => ['u-color__text--darker']
                            ])
                                "{{$testimonial['testimonial']}}"
                            @endtypography
                        </div>
                    </div>
                @endforeach
    </{{ $componentElement }}>
@endif
