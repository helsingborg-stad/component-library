@card([
    'classList' => [$class]
])
    @image([
        'classList' => [$baseClass . '__image'],
        'src'=> $testimonial['image'],
        'alt' => $testimonial['name']
    ])
    @endimage

    <div class="{{ $baseClass}}__header">
        @typography([
                
                "element" => "h2",
                "classList" => [$baseClass . '__author']
            ])
            {{$testimonial['name']}}
        @endtypography

        @divider(['style' => 'solid'])
        @enddivider

        @typography([                            
            "element" => "h3",
            'variant' => 'h3',
            "classList" => [$baseClass . '__title']
        ])
            {{$testimonial['title']}}
        @endtypography
    </div>

    <div class="{{ $baseClass }}__quote">
        @typography([
            "element" => "p",
            "classList" => ['u-color__text--darker']
        ])
            "{{$testimonial['testimonial']}}"
        @endtypography
    </div>
@endcard