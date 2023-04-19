@if($title || $icon || $meta)
@group([
    'justifyContent' => 'space-between',
    'alignItems' => 'start',
    'gap' => 2,
])
    @group([
        'direction' => 'vertical'
    ])
    @if($title)
        @typography([
            "element" => "h2",
            "variant" => ($layout == 'full-width') ? 'h1' : ($layout == 'card' ? 'h3' : 'h2'),
            "classList" => [$baseClass . '__title'],
            "autopromote" => true
        ])
            {!! $title !!}
        @endtypography
        @endif
        
    @if($meta)
        @typography([
            'element' => 'span',
            'variant' => 'h4',
            'classList' => [$baseClass . '__meta'],
        ])
            {!! $meta !!}
        @endtypography
    @endif
    @endgroup

       @if ($icon && !empty($displayIcon))
        @inlineCssWrapper([
            'styles' => ['background-color' => $icon['backgroundColor'], 'display' => 'flex'],
            'classList' => [$icon['backgroundColor'] ? '' : 'u-color__bg--primary', 'u-rounded--full', 'u-detail-shadow-3']
        ])
            @icon($icon)
            @endicon
        @endinlineCssWrapper
    @endif
@endgroup
@endif

@if($date)
    @date([
        'action' => false,
        'timestamp' => $date,
        'classList' => [$baseClass."__date"]
    ])
    @enddate
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