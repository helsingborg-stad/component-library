    <div class="{{$baseClass}}__background" style="{{$background}}">
    </div>
        <div class="o-container">
              @group([
                'wrap' => 'wrap',
                'classList' => [$baseClass . '__content', 'o-grid', 'u-flex-direction--row--reverse']
            ])
                <div class="{{$baseClass}}__group">
                    @image([
                        'src' => $image,
                        'classList' => ['u-margin__bottom--0', $baseClass . '__group-image']
                    ])
                    @endimage
                </div>
                <div class="{{$baseClass}}__group">
                    @group([
                        'justifyContent' => 'center',
                        'direction' => 'vertical',
                        'classList' => [$baseClass . '__group-content']
                    ])
                        @if($customHeroData['contentSlotHasData'])
                            {!! $content !!}
                        @else
                            @if ($meta)
                                @typography(['classList' => [$baseClass . '__meta']])
                                    {!! $meta !!}
                                @endtypography
                            @endif
                            @if ($title)
                                @typography([
                                    'variant' => 'h1', 'element' => 'h1', 
                                    'classList' => [$baseClass . '__title']
                                    ])
                                    {!! $title !!}
                                @endtypography
                            @endif

                            @if ($byline)
                                @typography([
                                    'variant' => 'h2', 'element' => 'span',
                                    'classList' => [$baseClass . '__byline']
                                    ])
                                    {!! $byline !!}
                                @endtypography
                            @endif

                            @if ($paragraph)
                                @typography([
                                    'element' => 'p',
                                    'classList' => [$baseClass . '__body']
                                ])
                                    {!! $paragraph !!}
                                @endtypography
                            @endif
                        @endif
                    @endgroup
                </div>
            @endgroup
        </div>