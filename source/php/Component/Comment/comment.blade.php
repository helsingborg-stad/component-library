<{{$componentElement}} class="{{ $class }}"  {!! $attribute !!}>

    <div class="{{$baseClass}}__col">
        @avatar([
            'name' => $author,
            'image' => $author_image,
            'icon' => [
                'name' => $icon,
                'size' => 'lg'
            ]
        ])
        @endavatar
    </div>

    <div class="{{$baseClass}}__col">

        <div class="{{$baseClass}}__top">

            @link(['href' => $author_url, 'classList' => ['c-comment__link']])
                @typography([
                    "variant" => "title",
                    "element" => "h6",
                    "classList" => [$baseClass.'__author']
                ])
                    {{$author}}
                @endtypography
            @endlink
    
            @if ($date)
                @typography([
                    "variant" => "meta",
                    "element" => "span",
                    "classList" => [$baseClass.'__date']
                ])
                    @date([
                        'action' => 'timesince',
                        'timestamp' => $date,
                        'labels' => $dateLabels,
                        'labelsPlural' => $dateLabelsPlural
                    ])
                    @enddate
    
                    @if ($date_suffix) {{$date_suffix}} @endif
                @endtypography
            @endif
        </div>
    
        <div class="{{$baseClass}}__bubble {{$baseClass}}__bubble--color-{{$bubble_color}}">
            @if($text)
                @typography([
                    "variant" => "body",
                    "element" => "p",
                    "classList" => [$baseClass.'__bubble--inner']
                ])
                    {!! $text !!}
                @endtypography
            @endif
    
            @if($slotHasData)
                <div class="{{$baseClass}}__bubble--inner">
                    {!! $slot !!}
                </div>
            @endif
        </div>

        @if($actions)
            <div class="{{$baseClass}}__actions">
                {!! $actions !!}
            </div>
        @endif
    </div>
</{{$componentElement}}>