<!-- iframe.blade.php -->
@acceptance([
    "labels"    => $labels,
    "modifier"  => $modifier,
    "height"    => $height,
    "src"       => array($attributeList['src']),
    "icon"      => "info",
	"allowfullscreen" => false
    ])
    <iframe 
        id="{{ $id }}" class="{{$class}}" {!! $attribute !!}>
    </iframe>
@endacceptance

