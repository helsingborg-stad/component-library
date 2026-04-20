@if (is_array($heading))
    @foreach($heading as $index => $headingItem)
        @if ($index === 0)
            @typography([
                'element' => 'h3',
                'variant' => 'h6',
                'classList' => [$accordionClass . '__button-column']
            ])
                {!! $headingItem !!}
            @endtypography
            @else
            <span class="{{$accordionClass}}__button-column">{{$headingItem}}</span>
        @endif
    @endforeach
@else
    @typography([
        'element' => 'h3',
        'variant' => 'h6',
        'classList' => [$accordionClass . '__button-column']
    ])
        {!! $heading !!}
    @endtypography
@endif