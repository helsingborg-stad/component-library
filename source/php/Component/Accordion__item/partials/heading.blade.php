@if (is_array($heading))
    @foreach($heading as $index => $headingItem)
        @if ($index === 0)
            @typography([
                'element' => 'h3',
                'variant' => 'h4',
                'classList' => [$baseClass . '__button-column']
            ])
                {!! $headingItem !!}
            @endtypography
            @else
            <span class="{{$baseClass}}__button-column">{{$headingItem}}</span>
        @endif
    @endforeach
@else
    @typography([
        'element' => 'h3',
        'variant' => 'h4',
        'classList' => [$baseClass . '__button-column']
    ])
        {!! $heading !!}
    @endtypography
@endif