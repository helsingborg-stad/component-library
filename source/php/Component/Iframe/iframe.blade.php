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
                const iframe        = acceptance.querySelector('#{{$id}}');
                let message         = e.data;

                if(iframe && acceptance && message && message.height) {
                    iframe.height           = message.height;
                    acceptance.style.height = message.height + 'px';
                }
            },
            false
        );
    </script>
@endacceptance
