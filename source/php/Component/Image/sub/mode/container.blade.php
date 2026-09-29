<!-- Image assets -->
@foreach($containerQueryData as $item)
  <img 
    class="{{$baseClass}}__image {{$baseClass}}--{{$item['uuid']}}" 
    src="{{$item['url']}}"
    alt="{{$alt}}"
    style="{{$focus}}"
    @if($item['dimensions'])
      width="{{$item['dimensions'][0]}}"
      height="{{$item['dimensions'][1]}}"
    @endif
    {!! $imgAttributes !!}
  />
@endforeach
