<!-- testimonials.blade.php -->
@if($testimonials && !$isCarousel)
<div class="{{$baseClass .'s'}}">
    <div class="{{$baseClass .'s__wrapper'}} {{$wrapperClassList}}"  {!! $wrapperAttributeList !!} style="transform: translateX(0%);">
        @foreach($testimonials as $testimonial)
            @card ([
                'classList' => [$class]
            ])
                @include('Testimonials.partials.item')    
            @endcard
        @endforeach
    </div>
</div>
@endif

@if (count($testimonials) > 1 && $isCarousel)
    @slider([])
        @foreach($testimonials as $testimonial)
            @card([
                'classList' => [$class]
            ])
                @include('Testimonials.partials.item')
            @endcard
        @endforeach
    @endslider
@endif
