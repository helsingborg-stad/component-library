<{{ $componentElement }} id="{{ $id }}" class="{{ $class }}" {!! $attribute !!}>
    {{ $slot }}
    <ul class="{{ $baseClass }}__list">
        @if (!$listSlotHasContent)
        @foreach ($items as $item)
            <li {!! $item['attributes'] !!}>
                <{{ $itemElement }} href="{{ $item['link'] }}" aria-label="{{ $item['text'] }}"
                    {!! $item['linkAttributes'] !!}>
                    {{ $item['text'] }}
                </{{ $itemElement }}>
            </li>
        @endforeach
        @else
            {!! $list !!}
        @endif

    </ul>
</{{ $componentElement }}>
