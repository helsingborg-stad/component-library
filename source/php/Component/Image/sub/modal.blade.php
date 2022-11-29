@modal([
    'heading'=> $heading,
    'isPanel' => $isPanel,
    'id' => $modalId,
    'overlay' => 'dark',
    'animation' => 'scale-up',
    'transparent' => $isTransparent,
])

    @image([
        'src'=> $src,
        'alt' => $alt,
        'imgAttributeList' => [
            'width' => $imgAttributeList['width'],
            'height' => $imgAttributeList['height'],
            'srcset' => $imgAttributeList['srcset'],
        ]
    ])
    @endimage

@endmodal

