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
<div class="{{$baseClass . 's-carousel'}}">
    @slider([
        'showStepper' => false,
        'autoSlide' => false,
        'repeatSlide' => true,
    ])
        {{-- 1st ITEM --}}
        @slider__item([])
            @card(['classList' => [$baseClass .'s-carousel__item']]) 
                @image([
                    'classList' => [$baseClass . '__image'],
                    'src'=> 'https://picsum.photos/1080/720',
                    'alt' => ''
                    ])
                @endimage
                    
                <div class="{{$baseClass .'__header'}}">               
                    @typography([
                        "element" => "h2",
                        "classList" => ['u-color__text--darker']
                    ])
                        Pamela Cronqvist
                    @endtypography

                    @divider(['style' => 'solid'])
                    @enddivider
                    
                    @typography([                            
                        "element" => "h3",
                        'variant' => 'h3',
                        "classList" => ['u-color__text--darker']
                    ])
                        Lärare i svenska och engelska
                    @endtypography
                </div>

                <div class="{{ $baseClass }}__quote">
                    @typography([
                        "variant" => "p",
                        "element" => "p",
                        "classList" => ['u-color__text--darker', ]
                    ])
                        ”Tycho Braheskolan är en skola där både elever och lärare trivs. Vi har en stark studietradition och är en uttalad ”pluggskola”, men samtidigt vet vi att man måste ha roligt för att lära sig. Ambitionerna är höga och tillsammans jobbar vi för att nå bästa möjliga resultat.”
                    @endtypography
                </div> 
            @endcard 
        @endslider__item
        
        {{-- 2nd ITEM --}}
        @slider__item([])
            @card(['classList' => [$baseClass .'s-carousel__item']]) 
                @image([
                    'classList' => [$baseClass . '__image'],
                    'src'=> 'https://picsum.photos/1080/720',
                    'alt' => ''
                    ])
                @endimage
                    
                <div class="{{$baseClass .'__header'}}">               
                    @typography([
                        "element" => "h2",
                        "classList" => ['u-color__text--darker']
                    ])
                        Pamela Cronqvist
                    @endtypography

                    @divider(['style' => 'solid'])
                    @enddivider
                    
                    @typography([                            
                        "element" => "h3",
                        'variant' => 'h3',
                        "classList" => ['u-color__text--darker']
                    ])
                        Lärare i svenska och engelska
                    @endtypography
                </div>

                <div class="{{ $baseClass }}__quote">
                    @typography([
                        "variant" => "p",
                        "element" => "p",
                        "classList" => ['u-color__text--darker', ]
                    ])
                        ”Tycho Braheskolan är en skola där både elever och lärare trivs. Vi har en stark studietradition och är en uttalad ”pluggskola”, men samtidigt vet vi att man måste ha roligt för att lära sig. Ambitionerna är höga och tillsammans jobbar vi för att nå bästa möjliga resultat.”
                    @endtypography
                </div> 
            @endcard 
        @endslider__item


    @endslider
</div>
@endif
