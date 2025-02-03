@if(($caption || $byline) && !$removeCaption)
  <figcaption>
      @if($caption)
          <span class="{{$baseClass}}__caption">{{ $caption }}</span><br>
      @endif
      @if($byline)
          <span class="{{$baseClass}}__byline">{{ $byline }}</span>
      @endif
  </figcaption>
@endif