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
<div class="{{$baseClass . 's__slider'}}">
    @slider([
        'showStepper' => false,
        'autoSlide' => false,
    ])
        @foreach($testimonials as $testimonial)
            @slider__item(['classList' => [$baseClass .'s__slider__item']])
                @card([]) 
                    @include('Testimonials.partials.item')
                @endcard 
            @endslider__item
        @endforeach
        
    @endslider
</div>
@endif
