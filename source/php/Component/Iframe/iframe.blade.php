<!-- iframe.blade.php -->
@acceptance([
    "labels" => $labels,
    "modifier" => $modifier,
    "height" => $height,
])
    <iframe 
        id="{{ $id }}" 
        src="about:blank"
        height="{{$height}}" 
        width="{{$width}}" 
        loading="{{$loading}}">
    </iframe>
@endacceptance

