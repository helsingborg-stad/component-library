<!-- brand.blade.php -->
@if($text)
<div class="{{ $class }}" {!! $attribute !!}>
    <div class="{{ $baseClass }}__viewbox">

            <div class="{{ $baseClass }}__container" xmlns="http://www.w3.org/1999/xhtml">

                @if($logotype)
                    @logotype($logotype)
                    @endlogotype
                @endif
                
                <svg class="{{ $baseClass }}__text-wrapper" viewBox="0 0 500 100" preserveAspectRatio="xMinYMid meet">
                    <foreignObject width="100%" height="100%" xmlns="http://www.w3.org/1999/xhtml">
                        <div class="{{ $baseClass }}__text">
                            @foreach($text as $line)
                                @typography([
                                    "variant" => "brand", 
                                    "element" => "span",
                                    "classList" => [
                                        $baseClass . "__line", 
                                        $baseClass . "__line--" . $loop->iteration
                                    ]
                                ])
                                    {{ $line }}
                                @endtypography
                            @endforeach
                        </div>
                    </foreignObject>
                </svg>
            </div>

    </div>
</div>
@else 
    @if($logotype)
        @logotype($logotype)
        @endlogotype
    @endif
@endif