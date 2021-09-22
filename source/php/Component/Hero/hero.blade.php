<!-- hero.blade.php -->
<div id="{{ $id }}" class="{{$class}}" {!! $attribute !!}>
    
    @if($title || $paragraph) 
        <div class="o-container {{ $baseClass }}__container">

            @if($title)
                @typography(['variant' => 'h1', 'element' => 'h1', 'classList' => ''])
                    {!! $title !!}
                @endtypography
            @endif

            @if($paragraph)
                @typography(['variant' => 'p', 'element' => 'p', 'classList' => ''])
                    {!! $paragraph !!}
                @endtypography
            @endif
        </div>

    @endif
</div>