<!-- card.blade.php -->
<{{ $componentElement }} class="{{$class}}" {!! $attribute !!}>
    @includeWhen(!$slotHasData, 'Card.views.base')
    {!! $slot !!}
    @includeWhen($afterContentSlotHasData, 'Card.views.after-content')
</{{ $componentElement }}>

