@if(!empty($tags))
    <{{ $componentElement }} id="{{$uid}}" class="{{ $class }}" {!! $attribute !!}>
        @foreach($tags as $tag)
            @if(isset($tag['href']) && !empty($tag['href']))
                @link([
                    'href' => $tag['href'], 
                    'classList' => [
                        'c-tag', 
                        'c-tag--'.$tag['color'], 
                        $isHidden($loop->index)
                    ]
                ])
                    {{ $beforeLabel }}{{ $tag['label'] ?? 'Undefined label' }}{{ $afterLabel }}
                @endlink
            @else 
                <span class="c-tag c-tag--{{ $tag['color'] }} {{ $isHidden($loop->index) }}">
                    {{ $beforeLabel }}{{ $tag['label'] ?? 'Undefined label' }}{{ $afterLabel }}
                </span>
            @endif
        @endforeach

        @if($compress && $compress < $tagCount)
            <span class="c-tag c-tag--{{ $tag['color'] }} c-tag--more">
                {{ "..." }}
            </span>
        @endif

    </{{ $componentElement }}>
@endif
