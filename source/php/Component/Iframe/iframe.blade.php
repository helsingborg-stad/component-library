<!-- iframe.blade.php -->
@if($src)
<iframe id="{{ $id }}" class="{{ $class }}" src="{{ $src }}" width="{{ $width }}" height="{{ $height }}" {!! $attribute !!}></iframe>
@else 
<!-- No iframe source defined -->
@endif
