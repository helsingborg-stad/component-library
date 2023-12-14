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
                    const iframeBody = iframe.contentWindow.document.body
                    const iframeResizeObserver = new ResizeObserver(function() {
                        const targetHeight = iframeBody.scrollHeight + 'px' || 'auto';
                        acceptance.style.height = targetHeight;
                        iframe.style.height = targetHeight;
                    });
                    iframeResizeObserver.observe(iframeBody);
                }
            }
        </script>
    @endif
@endacceptance
