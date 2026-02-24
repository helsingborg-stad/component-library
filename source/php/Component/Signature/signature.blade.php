<{{$componentElement}} class="{{$class}}" {!! $attribute !!}>
    
    @if($author||$published||$updated)
        @if ($avatar || $placeholderAvatar)
            @avatar([
                'image' => ($avatar) ? $avatar : false,
                'name' => $author,
                'size' => $avatar_size,
                "classList" => [
                    $baseClass.'__avatar'
                ]
            ])
            @endavatar
        @endif
        <div class="{{$baseClass}}__author-box">
            @if($author)
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
                        {!! $slot !!}
                </div>
            @endif
            @if($published||$updated)
                <div class="{{$baseClass}}__dates {{$author ? $baseClass.'__dates--aligned' : ''}}">

                    @if ($published)
                        @typography([
                            "element" => "span",
                            "variant" => "byline",
                            "classList" => [
                                $baseClass.'__published'
                            ]
                        ])
                            {{$label->publish}}: @date(['action' => false,'timestamp' => $published])@enddate
                        @endtypography
                    @endif
                    
                    @if ($updated)
                        @typography([
                            "element" => "span",
                            "variant" => "byline",
                            "classList" => [
                                $baseClass.'__updated'
                            ]
                        ])
                            {{$label->updated}}: @date(['action' => false,'timestamp' => $updated])@enddate
                        @endtypography
                    @endif
                    
                </div>
            @endif
        </div>
    @endif

</{{$componentElement}}>
