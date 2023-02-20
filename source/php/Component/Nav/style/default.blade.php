<a  id="{{$id}}-{{$item['id']}}-{{$loop->index}}__label" class="{{$baseClass}}__link {{$item['class']}}"  href="{{$item['href']}}" @if($item['label']) aria-label="{{$item['label']}}" @endif>
  @if(isset($item['icon']))
      @icon($item['icon'])
      @endicon
  @endif
  
  @if($item['label'])
    <span class="{{$baseClass}}__text">{{$item['label']}}</span>
  @endif
</a>