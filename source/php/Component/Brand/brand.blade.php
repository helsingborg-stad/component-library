<!-- brand.blade.php -->
@if($text)
<div class="{{ $class }}" {!! $attribute !!}>
    <svg viewBox="0 0 500 100" preserveAspectRatio="xMinYMid meet" class="{{ $baseClass }}__viewbox">
        <foreignObject width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
            <div class="{{ $baseClass }}__container" xmlns="http://www.w3.org/1999/xhtml">

                @if($logotype)
                    @logotype($logotype)
                    @endlogotype
                @endif

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
            </div>
        </foreignObject>
    </svg>
</div>
@else 
    @if($logotype)
        @logotype($logotype)
        @endlogotype
    @endif
@endif