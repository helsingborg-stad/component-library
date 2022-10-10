<!-- testimonials.blade.php -->
@if($testimonials && !$isCarousel)
<div class="{{$baseClass .'s'}}">
    <div class="{{$baseClass .'s__wrapper'}} {{$wrapperClassList}}"  {!! $wrapperAttributeList !!} style="transform: translateX(0%);">
        @foreach($testimonials as $testimonial)
            @include('Testimonials.partials.item')    
        @endforeach
    </div>
</div>
@endif

@if (count($testimonials) > 1 && $isCarousel)
<div class="{{$baseClass .'s'}}">
    <div class="{{$baseClass . 's__slider'}}">
        @slider([
            'showStepper' => false,
            'autoSlide' => false,
            'attributeList' => [
                'data-slides-per-page' => $slidesPerPage,
            ]
        ])
            @foreach($testimonials as $testimonial)
                @slider__item(['classList' => [$baseClass .'s__slider__item']])
                    @include('Testimonials.partials.item')
                @endslider__item
            @endforeach
            
        @endslider
    </div>
</div>
@endif
