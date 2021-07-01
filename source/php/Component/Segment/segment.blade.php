<!-- segment.blade.php -->
<section id="{{ $id }}" class="{{ $class }}" {!! $attribute !!}>

    @if ($image)
        <img class="{{$baseClass}}__image {{ $imageClass }}" src="{{$image}}" alt=""/>
    @endif

    <div class="{{$baseClass}}__content o-container o-container--content o-container--keep-spacing">
    
        @if($title||$content)
            <div class="{{$baseClass}}__padder">
                
                @if($title)
                    @typography([
                        "element" => "h2",
                        "variant" => "h1",
                        "classList" => [$baseClass . '__title'],
                    ])
                        {{ $title }}
                    @endtypography
                @endif

                @if($content)
                    @typography([
                        "variant" => "p",
                        "classList" => [$baseClass . '__text'],
                    ])
                        {{ $content }}
                    @endtypography
                @endif

                @if($buttons)
                    <div class="{{$baseClass}}__buttons">
                        @foreach($buttons as $button) 
                            @button($button)
                            @endbutton
                        @endforeach
                    </div>
                @endif

                @if ($slotHasData && $layout == 'split')
                    <div class="{{$baseClass}}__slot">
                        {{ $slot }}
                    </div>
                @endif

            </div>
        @endif

    </div>
    
    @if ($slotHasData && $layout == 'full-width')
        <div class="{{$baseClass}}__slot o-container">
            {{ $slot }}
        </div>
    @endif
    
</section>