<div class="{{$baseClass}}__body">
    @includeWhen($collapsible, 'Card.components.collapsiableButton')
    @includeWhen($heading, 'Card.components.heading')
    @includeWhen($subHeading, 'Card.components.subHeading')
    @includeWhen($content, 'Card.components.content')

    @if($arrowRight)
    @icon(['icon' => 'chevron_right', 'size' => 'md', 'classList' => ['c-card__chevron']])
    @endicon
    @endif
</div>