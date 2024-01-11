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
    <script>
        window.addEventListener(
            'message',
            function(e) {
                if (!e.origin.match('{{$embeddedDomain}}')) {
                    return;
                }
                const acceptance    = document.querySelector('#acceptance-{{$id}}');
                const iframe        = document.querySelector('#{{$id}}');
                const message       = e.data;

                if(acceptance && message && message.height) {
                    acceptance.style.height = message.height + 'px';
                }
                if(iframe && message && message.height) {
                    iframe.height           = message.height;
                }
            },
            false
        );
    </script>
@endacceptance
