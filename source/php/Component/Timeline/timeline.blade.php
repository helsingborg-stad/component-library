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
                'link' => $event['link']
            ])
                @if (isset($event['imageSrc']))
                    <div class="c-card__image">
                        <div class="c-card__image-background u-ratio-16-9" alt="{{ $event['title'] }}"
                            style="background-image:url('{{ $event['imageSrc'][0] }}');"></div>
                    </div>
                @endif

                <div class="c-card__body">
                    <h3 class="{{ $baseClass }}__title">{{ $event['title'] }}</h3>
                    {!! $event['content'] !!}
                </div>
            @endcard
        </li>
    @endforeach
</ul>
