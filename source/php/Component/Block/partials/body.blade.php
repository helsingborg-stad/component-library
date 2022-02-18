<div class="{{$baseClass}}__body">
    @includeWhen($collapsible, 'Block.components.collapsiableButton')
    @includeWhen($heading, 'Block.components.heading')
    @includeWhen($subHeading, 'Block.components.subHeading')
    @includeWhen($meta, 'Block.components.meta')
    @includeWhen($content, 'Block.components.content')

    @if($hasAction)
    @icon(['icon' => 'chevron_right', 'size' => 'md', 'classList' => ['c-card__action']])
    @endicon
    @endif
</div>