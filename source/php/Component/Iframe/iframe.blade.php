<!-- iframe.blade.php -->
@acceptance([
    "labels" => $labels,
    "modifier" => $modifier,
    "height" => $height,
    "data-src" => $src,
])
    <iframe 
        id="{{ $id }}" 
        src="{{$src}}"
        height="{{$height}}" 
        width="{{$width}}" 
        loading="{{$loading}}">
    </iframe>
@endacceptance

