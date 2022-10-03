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
    @slider([
        'showStepper' => true,
        'autoSlide' => false,
        'repeatSlide' => true,
    ])
        @slider__item([
            'title' => 'First slider item',
            'sub_title' => 'This is a slightly longer title called subtitle',
            'text' => 'Here I could put some lorem ipsum text but I am too lazy to Google for one so I wrote all this instead. Woo!',
            'layout' => 'center',
            'containerColor' => 'none',
            'overlay' => 'dark',
            'textColor' => 'white',
            'textAlignment' => 'center',
            'mobile_image' => 'https://picsum.photos/720/720',
            'desktop_image' => 'https://picsum.photos/1080/720',
            'heroStyle' => true
        ])
        @endslider__item

        @slider__item([
        ])
            @card([
            ])                
                <div class="{{ $baseClass}}__header">
                    @typography([
                            "element" => "h2",
                            "classList" => ['u-color__text--darker']
                        ])
                        name
                    @endtypography
                
                    @typography([                            
                        "element" => "h3",
                        'variant' => 'h3',
                        "classList" => ['u-color__text--darker']
                    ])
                        title
                    @endtypography
                </div>
                
                <div class="{{ $baseClass }}__quote">
                    @typography([
                        "variant" => "p",
                        "element" => "p",
                        "classList" => ['u-color__text--darker']
                    ])
                        "testimonial..."
                    @endtypography
                </div>
            @endcard 
        @endslider__item

    @endslider
@endif
