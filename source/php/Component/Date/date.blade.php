@if($tooltipDate)
  @tooltip([
    'componentElement' => 'span', 
    'placement' => 'top', 
    'label' => $refinedDate . ' ' . $timeSinceSuffix, 
    'icon' => false
  ])
    <time class="{{ $metaDate }} {{ $class }}" {!! $attribute !!}>{{ $tooltipDate }}</time>
  @endtooltip
@else
  <time class="{{ $metaDate }} {{$class}}" {!! $attribute !!}>{{ $refinedDate }} {{$timeSinceSuffix}}</time>
@endif