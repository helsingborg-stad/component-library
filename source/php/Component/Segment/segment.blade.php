<!-- segment.blade.php -->
<section id="{{ $id }}" class="{{ $class }}" {!! $attribute !!}>
    @if ($image)
        <div class="{{$baseClass}}__image {{ $imageClass }}" style="{{ $imageStyleString }}"></div>
    @endif

    <div class="{{$baseClass}}__content o-container o-container--content o-container--keep-spacing">
    
        @if($title||$content)
            <div class="{{$baseClass}}__padder">
                
                @if($title)
                    @typography([
                        "element" => "h2",
                        "variant" => ($layout == 'full-width') ? 'h1' : 'h2',
                        "classList" => [$baseClass . '__title'],
                        "autopromote" => true
                    ])
                        {!! $title !!}
                    @endtypography
                @endif

                @if($content)
                    @typography([
                        "variant" => "p",
                        "classList" => [$baseClass . '__text'],
                    ])
                        {!! $content !!}
                    @endtypography
                @endif

                @if($buttons)
                    <div class="{{$baseClass}}__buttons">
                        @foreach($buttons as $button) 
                            @button($button)
                            @endbutton
                        @endforeach
                    </div>
                @endif

                @if ($slotHasData && $layout == 'split')
                    <div class="{{$baseClass}}__slot">
                        {{ $slot }}
                    </div>
                @endif

                @if($layout == 'split' || $layout == 'featured')
                    {{-- Oneline to enable the use of css:empty() function --}}
                    <div class="{{$baseClass}}__inner-blocks u-hide-empty">{!! '<InnerBlocks />' !!}</div>
                @endif

            </div>
        @endif

    </div>
    
    @if ($slotHasData && $layout == 'full-width')
        <div class="{{$baseClass}}__slot o-container">
            {{ $slot }}
        </div>
    @endif

    @if($layout == 'full-width')
        {{-- Oneline to enable the use of css:empty() function --}}
        <div class="{{$baseClass}}__inner-blocks o-container u-margin__x--auto u-hide-empty">{!! '<InnerBlocks />' !!}</div>
    @endif
    
</section>