<!-- card.blade.php -->
<{{ $componentElement }} class="{{$class}}" {!! $attribute !!}>
    <div class="c-card__paint-container">
        @includeWhen($beforeContentSlotHasData, 'Card.views.before-content')
        @includeWhen(!$slotHasData, 'Card.views.base')
        {!! $slot !!}
        @includeWhen($afterContentSlotHasData, 'Card.views.after-content')
    </div>
</{{ $componentElement }}>
