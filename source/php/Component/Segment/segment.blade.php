<!-- segment.blade.php -->
<section id="{{ $id }}" class="{{ $class }}" {!! $attribute !!}>

    @if ($image)
    <img class="{{$baseClass}}__image" src="{{$image}}"/>
    @endif

    <div class="{{$baseClass}}__content o-container o-container--content">
        @if($title)
        @typography([
            "variant" => "h2",
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

    </div>
    
    @if ($slotHasData)
    <div class="{{$baseClass}}__slot o-container o-container--wide">
        {{ $slot }}
    </div>
    @endif
    

</section>