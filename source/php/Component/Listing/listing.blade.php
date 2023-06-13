<!-- listing.blade.php -->
@if ($list)
    <{{ $elementType }} class="{{ $class }}" {!! $attribute !!}>

        @foreach ($list as $item)
            {{-- - List item - --}}
            @if (!empty($item))
                @if (!empty($item['href']))
                    <li class="{{ $baseClass }}__item {{ $baseClass }}__item-{{ $loop->index }}">
                        <a class="{{ $baseClass }}__link" href="{{ $item['href'] }}" aria-label="{{ $item['label'] }}">
                            @icon([
                                'icon' => $item['icon']['src'],
                                'size' => $item['size'] ?? 'md'
                            ])
                            @endicon
                            <span class="{{ $baseClass }}__label">
                              {{ $item['label'] }}
                            </span>
                            @if ($icon)
                                @icon(['icon' => 'chevron_right', 'size' => 'md'])
                                @endicon
                            @endif
                        </a>
                        @include('Listing.sub') {{-- - Recursive action - --}}
                    </li>
                @else
                    <li class="{{ $baseClass }}__item {{ $baseClass }}__item-{{ $loop->index }}">
                        @icon([
                            'icon' => $item['icon']['src'],
                            'size' => $item['size'] ?? 'md'
                        ])
                        @endicon
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
