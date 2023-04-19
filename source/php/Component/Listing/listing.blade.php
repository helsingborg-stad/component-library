<!-- listing.blade.php -->
@if ($list)
    <{{ $elementType }} class="{{ $class }}" {!! $attribute !!}>

        @foreach ($list as $item)
            {{-- - List item - --}}
            @if (!empty($item))
                @if (!empty($item['href']))
                    <li class="{{ $baseClass }}__item {{ $baseClass }}__item-{{ $loop->index }}">
                        <a class="{{ $baseClass }}__link" href="{{ $item['href'] }}" aria-label="{{ $item['label'] }}">
                            @includeWhen(!empty($item['icon']), 'Listing.item-icon', ['item' => $item])
                            <span class="{{ $baseClass }}__label">
                                {{ $item['label'] }}
                                @if ($icon)
                                    @icon(['icon' => 'chevron_right', 'size' => 'md'])
                                    @endicon
                                @endif
                            </span>
                        </a>
                        @include('Listing.sub') {{-- - Recursive action - --}}
                    </li>
                @else
                    <li class="{{ $baseClass }}__item {{ $baseClass }}__item-{{ $loop->index }}">
                        @includeWhen(!empty($item['icon']), 'Listing.item-icon', ['item' => $item])
                        <span class="{{ $baseClass }}__label">
                            @if (isset($item['label']) && !empty($item['label']))
                                {!! $item['label'] !!}
                            @endif
                        </span>
                        @include('Listing.sub') {{-- - Recursive action - --}}
                    </li>
                @endif
            @endif
        @endforeach

        </{{ $elementType }}>
    @else
        <!-- No pagination data -->
@endif
