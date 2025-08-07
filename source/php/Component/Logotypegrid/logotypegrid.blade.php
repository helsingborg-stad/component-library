<!-- logotypegrid.blade.php -->
@if($items) 
    <div class="{{ $class }}" {!! $attribute !!}>
        @foreach($items as $item)
            @if(!empty($item->url))
                @include('Logotypegrid.partials.link')
            @else
                @include('Logotypegrid.partials.noLink')
            @endif
        @endforeach
    </div>
@endif
