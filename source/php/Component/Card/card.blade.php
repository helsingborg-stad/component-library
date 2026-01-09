<!-- card.blade.php -->
<{{ $componentElement }} class="{{$class}}" {!! $attribute !!}>
    <div class="c-card__paint-container">
        @includeWhen(!$slotHasData, 'Card.views.base')
        {!! $slot !!}
        @includeWhen($afterContentSlotHasData, 'Card.views.after-content')
    </div>
</{{ $componentElement }}>
