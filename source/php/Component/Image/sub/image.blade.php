<div 
  class="{{$baseClass}}__image-wrapper"
  {!! $wrapperAttributes !!}
>
  @includeWhen($containerQueryData, 'Image.sub.mode.container')
  @includeWhen(!$containerQueryData, 'Image.sub.mode.standard')
</div>