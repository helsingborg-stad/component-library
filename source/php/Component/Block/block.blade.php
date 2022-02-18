<!-- card.blade.php -->
<{{ $componentElement }} href="{{ $link }}" id="{{ $id }}" class="{{$class}}" {!! $attribute !!}>
    @includeWhen(!$slotHasData, 'Block.views.base')

    {!! $slot !!}
</{{ $componentElement }}>