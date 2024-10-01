<!-- <div class="{{$baseClass}}__image {{$baseClass}}__image--{{$image['backgroundColor']}}">
    <div class="{{$baseClass}}__image-background {{$paddedImage}}" style="background-image:url('{{$image['src']}}');"></div>
</div> -->
<div class="{{$baseClass}}__image-container">
    @image([
        'src' => $image['src'],
        'alt' => $image['alt'],
        'cover' => true,
        'classList' => [
            $baseClass . '__image'
        ]
    ])
    @endimage
</div>