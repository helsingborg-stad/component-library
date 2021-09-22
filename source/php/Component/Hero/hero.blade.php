<!-- hero.blade.php -->
<div id="{{ $id }}" class="{{ $class }}" {!! $attribute !!} style="{!! $imageStyleString !!}">
    
    @if($overlay)
        <div class="{{ $baseClass }}__overlay"></div>
    @endif

    @if($title||$paragraph||$byline) 
        <div class="o-container {{ $baseClass }}__container">

            <div class="{{ $baseClass }}__content">

                @if($title)
                    @typography(['variant' => 'h1', 'element' => 'h1', 'classList' => [$baseClass . '__title']])
                        {!! $title !!}
                    @endtypography
                @endif

                @if($byline)
                    @typography(['variant' => 'h2', 'element' => 'span', 'classList' => [$baseClass . '__byline']])
                        {!! $byline !!}
                    @endtypography
                @endif

                @if($paragraph)
                    @typography(['variant' => 'p', 'element' => 'p', 'classList' => [$baseClass . '__body']])
                        {!! $paragraph !!}
                    @endtypography
                @endif

            </div>

        </div>
    @endif
</div>