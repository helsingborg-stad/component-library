<!-- Image assets -->
@foreach($containerQueryData as $item)
  <img 
    class="{{$baseClass}}__image {{$baseClass}}--{{$item['uuid']}}" 
    src="{{$item['url']}}"
    alt="{{$alt}}"
    style="{{$focus}}"
    {!! $imgAttributes !!}
  />
@endforeach
