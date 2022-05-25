<{{$componentElement}} id="{{ $id }}" class="{{ $class }}"  {!! $attribute !!}>
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
                "element" => "p",
                "classList" => [$baseClass.'__date']
            ])
                @date([
                    'action' => 'timesince',
                    'timestamp' => $date
                ])
                @enddate

                @if ($date_suffix) {{$date_suffix}} @endif
            @endtypography
        @endif
    </div>

    <div class="{{$baseClass}}__bubble {{$baseClass}}__bubble--color-{{$bubble_color}}">
        @avatar([
            'name' => $author,
            'image' => $author_image,
            'icon' => [
                'name' => $icon,
                'size' => 'lg'
            ],
            
        ])
        @endavatar

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
</{{$componentElement}}>