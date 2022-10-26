<!-- iframe.blade.php -->
@acceptance([
    "labels"    => $labels,
    "modifier"  => $modifier,
    "height"    => $height,
    "src"       => $attributeList['src'],
    "policy"    => $supplierPolicy,
    "host"      => $supplierHost,
    "name"      => $supplierName,
    "icon"      => "info",
    ])
    <iframe 
        id="{{ $id }}" class="{{$class}}" {!! $attribute !!}>
    </iframe>
@endacceptance

