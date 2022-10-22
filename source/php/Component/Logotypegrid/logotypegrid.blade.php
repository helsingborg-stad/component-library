<!-- logotypegrid.blade.php -->
@if($items) 
    <div class="{{ $class }}" {!! $attribute !!}>
        @foreach($items as $item)
            @link(['href' => $item->url, 'classList' => [$baseClass . '__link']])
                @logotype([
                    'classList' => [$baseClass . '__logo'],
                    'src'=> $item->logo,
                    'alt' => $item->alt
                ])
                @endlogotype
            @endlink
        @endforeach
    </div>
@endif
