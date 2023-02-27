@if($title)
    @typography([
        "element" => "h2",
        "variant" => ($layout == 'full-width' || $layout == 'card') ? 'h1' : 'h2',
        "classList" => [$baseClass . '__title'],
        "autopromote" => true
    ])
        {!! $title !!}
    @endtypography
    @endif
    
@if($meta)
    @typography([
        'element' => "h3",
        'classList' => [$baseClass . '__meta'],
    ])
    {!! $meta !!}
    @endtypography
@endif
@if($tags) 
    @tags([
        'tags' => $tags,
        'classList' => [$baseClass . '__tags', 'u-margin__top--1'],
    ])
    @endtags
@endif

@if($content)
    @typography([
        "variant" => "p",
        "element" => "div",
        "classList" => [$baseClass . '__text'],
    ])
        {!! $content !!}
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