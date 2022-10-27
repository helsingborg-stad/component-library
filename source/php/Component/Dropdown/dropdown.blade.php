<{{ $componentElement }} id="{{ $id }}" class="{{ $class }}">
    {{ $slot }}
    <div class="{{ $baseClass }}__list {{ $baseClass }}__list--{{ $direction }}">
        <div>
            <ul class="u-margin__top--0">
                @foreach ($items as $item)
                    <li @if (!empty($item['classList'])) class="{{ implode(' ', $item['classList']) }}" @endif>
                        <{{ $itemElement }} href="{{ $item['link'] }}">
                            {{ $item['text'] }}
                            </{{ $itemElement }}>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    </{{ $componentElement }}>
