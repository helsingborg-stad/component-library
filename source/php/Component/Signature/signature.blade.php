<{{$componentElement}} class="{{$class}}" {!! $attribute !!}>
    
    @if($author)
        @avatar([
            'image' => ($avatar) ? $avatar : false,
            'name' => $author,
            'size' => $avatar_size,
            "classList" => [
                $baseClass.'__avatar'
            ]
        ])
        @endavatar

        <div class="{{$baseClass}}__author-box">
            <div>
                @typography([
                    "element" => "span",
                    "variant" => "subtitle",
                    "classList" => [
                        $baseClass.'__author'
                    ]
                ])
                    {{$author}}
                @endtypography

                @if($authorRole ) 
                    @typography([
                        "element" => "span",
                        "variant" => "byline",
                        "classList" => [
                            $baseClass.'__title'
                        ]
                    ])
                        {{$authorRole}}
                    @endtypography
                @endif
            </div>
        </div>
    @endif

    
    @if($published)
        <div class="{{$baseClass}}__dates {{$author ? $baseClass.'__dates--aligned' : ''}}">

            @typography([
                "element" => "span",
                "variant" => "byline",
                "classList" => [
                    $baseClass.'__published'
                ]
            ])
                {{$label->publish}}: @date(['action' => null,'timestamp' => $published])@enddate
            @endtypography
            
            @if ($updated)
                @typography([
                    "element" => "span",
                    "variant" => "byline",
                    "classList" => [
                        $baseClass.'__updated'
                    ]
                ])
                    {{$label->updated}}: @date(['action' => null,'timestamp' => $updated])@enddate
                @endtypography
            @endif
            
        </div>
    @endif

</{{$componentElement}}>