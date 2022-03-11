<div class="{{$baseClass}}__body">
    @includeWhen($collapsible, 'Card.components.collapsiableButton')
    @includeWhen($heading, 'Card.components.heading')
    @includeWhen($subHeading, 'Card.components.subHeading')
    @includeWhen($meta, 'Card.components.meta')
    @includeWhen($date, 'Card.components.date')
    @includeWhen($content, 'Card.components.content')

    @if($hasAction)
    @icon(['icon' => 'chevron_right', 'size' => 'md', 'classList' => ['c-card__action']])
    @endicon
    @endif
</div>