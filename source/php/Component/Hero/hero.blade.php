<!-- hero.blade.php -->
<section class="{{ $class }}" {!! $attribute !!}>
<div class="{{$baseClass}}__image" style="{!! $imageStyleString !!}" data-js-toggle-item="toggle-animation" data-js-toggle-class="u-animation--pause">
    </div>
    @if ($overlay)
        <div class="{{ $baseClass }}__overlay"></div>
    @endif

    @includeWhen($video || $hasAnimation, 'Hero.partials.controls');

    @if ($title || $paragraph || $byline)
        <div class="o-container {{ $baseClass }}__container">
            @if($video)
                <video autoplay muted loop class="c-hero__video">
                    <source src="{{$video}}" type="video/mp4">
                </video>
            @endif

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
</section>
