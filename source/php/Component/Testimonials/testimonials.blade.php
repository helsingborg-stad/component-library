<!-- testimonials.blade.php -->
@if($testimonials)
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

    @if (count($testimonials) > 1 && $isCarousel)
        @button([
            'style' => 'filled',
            'icon' => 'arrow_back',
            'size' => 'lg',
            'classList' => [
                $baseClass . 's__button'
            ],
            'attributeList' => [
                'js-testimonials__back' => ''
            ]
        ])
        @endbutton
        @button([
            'style' => 'filled',
            'icon' => 'arrow_forward',
            'size' => 'lg',
            'classList' => [
                $baseClass . 's__button',
            ],
            'attributeList' => [
                'js-testimonials__forward' => ''
            ]
        ])
        @endbutton
    @endif
</div>
@endif
