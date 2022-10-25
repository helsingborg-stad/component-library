@if($tooltipDate)
  @tooltip(['componentElement' => 'span', 'placement' => 'top'])
    @slot('title')
        {{ $tooltipDate }}
    @endslot
    <time class="{{ $metaDate }}" {!! $attribute !!}>{{ $refinedDate }}</time>
  @endtooltip
@else
  <time class="{{ $metaDate }}" {!! $attribute !!}>{{ $refinedDate }}</time>
@endif