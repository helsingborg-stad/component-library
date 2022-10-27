<!-- iframe.blade.php -->
@acceptance([
    "labels"    => $labels,
    "modifier"  => $modifier,
    "height"    => $height,
    "src"       => $attributeList['src'],
    "icon"      => "info",
    ])
    <iframe 
        id="{{ $id }}" class="{{$class}}" {!! $attribute !!}>
    </iframe>
@endacceptance

