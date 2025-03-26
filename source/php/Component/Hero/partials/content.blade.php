<div class="{{ $baseClass }}__content" style="{{ $contentStyles }}">
                
    @if( $linkArgs )
        @link($linkArgs)
    @endif

    @if ($meta)
        @typography(['classList' => [$baseClass . '__meta']])
            {!! $meta !!}
        @endtypography
    @endif
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
        @typography(['element' => 'p', 'classList' => [$baseClass . '__body']])
            {!! $paragraph !!}
        @endtypography
    @endif

    @if( $linkArgs )
        @endlink
    @endif

    @if( $buttonArgs )
        @button($buttonArgs)@endbutton
    @endif

    {{-- Oneline to enable the use of css:empty() function --}}
    @if ($isBlock)
        <div class="{{ $baseClass }}__inner-blocks u-hide-empty">{!! '<InnerBlocks />' !!}</div>
    @endif

</div>