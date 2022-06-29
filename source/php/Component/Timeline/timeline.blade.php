<ul class="{{ $class }}">
    @foreach ($events as $event)
        <li class="{{ $baseClass }}__event">
            <div class="{{ $baseClass }}__date u-visibility--hidden@sm u-visibility--hidden@xs">
                {!! $event['timelineDate'] !!}
            </div>
            <div class="{{ $baseClass }}__marker">
                <div class="{{ $baseClass }}__date u-visibility--hidden@md u-visibility--hidden@lg">
                    {!! $event['timelineDate'] !!}
                </div>
            </div>

            @card([
                'classList' => [$baseClass . '__event__card'],
                'context' => 'module.timeline.card',
                'link' => $event['link'],
                'heading' => $event['title'],
                'content' => $event['content'],
                'image' => isset($event['imageSrc'])
                    ? [
                        'src' => $event['imageSrc'][0],
                        'alt' => $event['title'],
                        'backgroundColor' => 'none'
                    ]
                    : []
            ])
            @endcard
        </li>
    @endforeach
</ul>
