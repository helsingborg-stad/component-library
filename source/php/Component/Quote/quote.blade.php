<div class="{{ $class }}" {!! $attribute !!}>
   @if($image)
        @image([
            'src' => $image->src,
            'alt' => $image->alt,
            'classList' => [
                $baseClass . '__image'
            ]
        ])
        @endimage
    @endif
    @if ($content || $footer)
        <div class="{{ $baseClass }}__content">
            @icon([
                'icon' => 'format_quote',
                'classList' => [
                    $baseClass . '__icon'
                ]
            ])
            @endicon
            @if($content)
                <div class="{{$baseClass}}__quote">
                    {!! $content !!}
                </div>                
            @endif

            <div class="{{$baseClass}}__footer">
                <div class="{{$baseClass}}__footer-content">
                    @if($footer)
                        {!! $footer !!}
                    @endif
                </div>
                @icon([
                    'icon' => 'format_quote',
                    'classList' => [
                        $baseClass . '__icon'
                    ]
                ])
                @endicon
            </div>
        </div>
    @endif
</div>