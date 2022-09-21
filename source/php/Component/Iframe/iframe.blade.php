<!-- iframe.blade.php -->
<iframe 
    id="{{ $id }}" 
    class="{{ $class }}" 
    data-src="{{ $src }}" 
    loading="{{ $loading }}" 
    height="{{ $height }}" 
    width="{{ $width }}"
    frameborder="0" 
    src="{{ $src }}"
    @if ($supplier && $policy) 
    data-supplier="{{$supplier}}"
    data-policy="{{$policy}}"
    @endif
    >
</iframe>
