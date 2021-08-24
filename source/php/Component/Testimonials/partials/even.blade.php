<div class="{{ $baseClass}}__header">
    @typography([
            
            "element" => "h2"
        ])
        {{$testimonial['name']}}
    @endtypography
    @divider(['style' => 'solid'])
    @enddivider
</div>
    @typography([                            
        "element" => "h3",
        'variant' => 'h3',
        "classList" => [ $baseClass . '__title' ]
    ])
        {{$testimonial['title']}}
    @endtypography
    @image([
        'src'=> $testimonial['image'],
        'alt' => $testimonial['name']
    ])
    @endimage