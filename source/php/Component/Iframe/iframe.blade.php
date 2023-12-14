<!-- iframe.blade.php -->
@acceptance([
    "id"       => 'acceptance-' . $id,
    "labels"   => $labels,
    "modifier" => $modifier,
    "height"   => $height,
    "src"      => array($attributeList['src']),
    "icon"     => "info",
    "cover"    => $poster,
    ])
    <iframe id="{{ $id }}" class="{{$class}}" {!! $attribute !!}>
    </iframe>
    @if($isSameTopDomain)
        <script>
            const acceptance    = document.querySelector('#acceptance-{{$id}}');
            const iframe        = acceptance?.querySelector('#{{$id}}');
            if(iframe) {
                iframe.onload = function() {
                    const targetHeight = iframe.contentWindow.document.body.scrollHeight + 'px' ?? 'auto';
                    acceptance.style.height = targetHeight;
                    iframe.style.height     = targetHeight;
                }
            }
        </script>
    @endif
@endacceptance
