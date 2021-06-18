<!-- segment.blade.php -->
<section id="{{ $id }}" class="{{ $class }}" {!! $attribute !!}>

    <img class="{{$baseClass}}__image" src="https://picsum.photos/1080/720"/>

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
    
    {{ $slot }}

</section>