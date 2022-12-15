<!-- card.blade.php -->
<{{ $componentElement }} class="{{$class}}" {!! $attribute !!}>
    @includeWhen(!$slotHasData, 'Card.views.base')
    {!! $slot !!}
    @if($afterContentSlotHasData)
        {!! $afterContent !!}
    @endif
</{{ $componentElement }}>

