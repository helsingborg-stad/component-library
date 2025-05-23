<ul class="{{ $class }}">
    @foreach ($events as $event)
        <li class="{{ $baseClass }}__event @if (isset($event['active_step']) && $event['active_step']){{$baseClass }}__event--active @endif">
            @if(!$sequential)
                <div class="{{ $baseClass }}__date u-visibility--hidden@sm u-visibility--hidden@xs">
                    {!! $event['timelineDate'] !!}
                </div>
            @endif
            <div class="{{ $baseClass }}__marker">
                @if(!$sequential)
                    <div class="{{ $baseClass }}__date u-visibility--hidden@md u-visibility--hidden@lg u-visibility--hidden@xl">
                        {!! $event['timelineDate'] !!}
                    </div>
                @endif
            </div>

            @card([
                'classList' => [$baseClass . '__event__card'],
                'context' => 'module.timeline.card',
                'link' => $event['link'],
                'heading' => $event['title'],
                'content' => $event['content'],
                'image' => is_array($event['imageSrc'])
                    ? [
                        'src' => $event['imageSrc'][0] ?? null,
                        'alt' => $event['title'],
                        'backgroundColor' => 'none'
                    ]
                    : ($event['imageSrc'] ?? null),
            ])
            @endcard
        </li>
    @endforeach
</ul>
