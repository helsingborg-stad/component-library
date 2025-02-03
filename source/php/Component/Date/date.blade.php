<time class="{{ $class }}" {!! $attribute !!}>{{ $refinedDate }} {{$timeSinceSuffix}}</time>

{{-- This will indicate that we have a formatting issue with the input date string or format. --}}
@if($dateError) 
  <!-- Date component: {!! $dateError !!} -->
@endif