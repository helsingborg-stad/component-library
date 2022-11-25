<!-- hero.blade.php -->
<div class="c-hero__wrapper" >
    <section class="{{ $class }}" {!! $attribute !!} style="{!! $imageStyleString !!}" data-js-toggle-item="toggle-animation" data-js-toggle-class="u-animation--pause" >
        @if ($overlay)
            <div class="{{ $baseClass }}__overlay"></div>
        @endif

        @if($video)
            <video autoplay muted loop class="c-hero__video">
                <source src="{{$video}}" type="video/mp4">
            </video>
        @endif
        
    </section>
    
    <div class="{{ $baseClass }}__controls" data-js-toggle-item="toggle-animation" data-js-toggle-class="show-play-button"> 
        @icon([
            'icon' => 'pause_circle',
            'size' => 'xl',
            'classList' => [$baseClass . '__animation-pause-button'],
            'attributeList' => [
                'data-js-toggle-trigger' => 'toggle-animation'
            ]
        ])
        @endicon

        @icon([
            'icon' => 'play_circle',
            'size' => 'xl',
            'classList' => [$baseClass . '__animation-play-button'],
            'attributeList' => [
                'data-js-toggle-trigger' => 'toggle-animation'
            ]
        ])
        @endicon
    </div>



    @if ($title || $paragraph || $byline)
        <div class="o-container {{ $baseClass }}__container">

            <div class="{{ $baseClass }}__content">
                @if ($title)
                @typography(['variant' => 'h1', 'element' => 'h1', 'classList' => [$baseClass . '__title']])
                {!! $title !!}
                @endtypography
                @endif
                
                @if ($byline)
                @typography(['variant' => 'h2', 'element' => 'span', 'classList' => [$baseClass . '__byline']])
                {!! $byline !!}
                @endtypography
                @endif
                
                @if ($paragraph)
                @typography(['variant' => 'p', 'element' => 'p', 'classList' => [$baseClass . '__body']])
                {!! $paragraph !!}
                @endtypography
                @endif
                
                {{-- Oneline to enable the use of css:empty() function --}}
                <div class="{{ $baseClass }}__inner-blocks u-hide-empty">{!! '<InnerBlocks />' !!}</div>
            </div>
            
        </div>
    @endif


</div> 
