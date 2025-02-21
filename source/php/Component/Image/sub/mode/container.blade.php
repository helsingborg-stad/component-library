<!-- Image assets -->
@foreach($containerQueryData as $item)
  <img 
    loading="lazy" 
    class="{{$baseClass}}__image {{$baseClass}}--{{$item['uuid']}}" 
    src="{{$item['url']}}"
    alt="{{$alt}}"
    style="{{$focus}}"
    {!! $imgAttributes !!}
  >
@endforeach

<!-- Image styles -->
<style>
  @supports (container-type: inline-size) {
    @foreach($containerQueryData as $item)
      @foreach(['landscape', 'portrait'] as $dimension)
        @container {{$item['media'][$dimension]}} and (orientation: {{$dimension}}) {
            .{{$baseClass}}.{{$baseClass}}--container-query .{{$baseClass}}--{{$item['uuid']}} {display: block;}
        }
      @endforeach
    @endforeach
  }
</style>