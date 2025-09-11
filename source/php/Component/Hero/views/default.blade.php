<div class="{{$baseClass}}__image" data-js-toggle-item="toggle-animation" data-js-toggle-class="u-animation--pause">
    @image([
        'src'=> $image,
        'cover' => true
    ])
    @endimage
</div>
    @if ($overlay)
        <div class="{{ $baseClass }}__overlay"></div>
    @endif

    @includeWhen($video || $hasAnimation, 'Hero.partials.controls')

    @if ($hasContent || $video)

        <div class="o-container {{ $baseClass }}__container">
            
            @if($video)
                <video autoplay muted loop playsinline poster="{{$poster}}" class="c-hero__video">
                    <source src="{{$video}}" type="video/mp4">
                </video>
            @endif

            @includeWhen($hasContent, 'Hero.partials.content')

        </div>
    @endif