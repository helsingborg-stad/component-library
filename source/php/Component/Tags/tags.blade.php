@if (!empty($tags))
    <{{ $componentElement }} class="{{ $class }}" id="{{ $uid }}" {!! $attribute !!}>
        @foreach ($tags as $tag)
            @if (isset($tag['href']) && !empty($tag['href']))
                @link([
                    'href' => $tag['href'],
                    'classList' => ['c-tags__tag', $isHidden($loop->index)]
                ])
                    {{ $beforeLabel }}
                    {{ $tag['label'] ?? 'Undefined label' }}
                    {{ $afterLabel }}
                @endlink
            @else
                <span class="c-tags__tag {{ $isHidden($loop->index) }}">
                    @if (!empty($icon))
                        @icon([
                            'icon' => $icon['icon'],
                            'size' => $icon['size'],
                            'customColor' => $tag['color'],
                            'classList' => ['u-margin__right--05']
                        ])
                        @endicon
                    @else
                        {{ $beforeLabel }}
                    @endif
                    {{ $tag['label'] ?? 'Undefined label' }}
                    {{ $afterLabel }}
                </span>
            @endif
        @endforeach

        @if ($compress && $compress < $tagCount)
            <span class="c-tags__tag c-tags__tag-more" data-js-compressed="{{$compress}}" data-js-compressed-class="is-hidden">
                ...({{$tagCount - $compress}})
            </span>
        @endif

        </{{ $componentElement }}>
@endif
