@if(!empty($tags))
    <{{ $componentElement }} id="{{$uid}}" class="{{ $class }}" {!! $attribute !!}>
        @foreach($tags as $tag)
            @if(isset($tag['href']) && !empty($tag['href']))
                @link([
                    'href' => $tag['href'], 
                    'classList' => [
                        'c-tags__tag', 
                        $isHidden($loop->index)
                    ]
                ])
                    {{ $beforeLabel }}{{ $tag['label'] ?? 'Undefined label' }}{{ $afterLabel }}
                @endlink
            @else 

                <span class="c-tags__tag {{ $isHidden($loop->index) }}">
                    @if (!empty($icon))
                        @icon([
                            'icon' => $icon['icon'],
                            'size' => $icon['size'],
                        ])
                        @endicon
                    @else
                        {{ $beforeLabel }}
                    @endif
                    {{ $tag['label'] ?? 'Undefined label' }}{{ $afterLabel }}
                </span>
            @endif
        @endforeach

        @if($compress && $compress < $tagCount)
            <span class="c-tags__tag c-tags__tag-more">
                {{ "..." }}
            </span>
        @endif

    </{{ $componentElement }}>
@endif
