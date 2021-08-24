<div class="{{ $baseClass}}__header">
    @image([
        'src'=> $testimonial['image'],
        'alt' => $testimonial['name']
    ])
    @endimage
    @typography([
            "variant" => "h2",
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