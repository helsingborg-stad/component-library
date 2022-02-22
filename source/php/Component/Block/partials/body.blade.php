<div class="{{$baseClass}}__body">
    @includeWhen($meta, 'Block.components.meta')
    @includeWhen($heading, 'Block.components.heading')

    @if($hasAction)
    @icon(['icon' => 'chevron_right', 'size' => 'md', 'classList' => ['c-card__action']])
    @endicon
    @endif
</div>