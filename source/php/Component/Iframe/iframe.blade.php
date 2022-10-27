<!-- iframe.blade.php -->
@acceptance([
    "labels"    => $labels,
    "modifier"  => $modifier,
    "height"    => $height,
    "src"       => $attributeList['data-src'],
    "policy"    => $supplierPolicy,
    "host"      => $supplierHost,
    "name"      => $supplierName,
    ])
    <iframe 
        id="{{ $id }}" class="{{$class}}" {!! $attribute !!}>
    </iframe>
@endacceptance

