<!-- header.blade.php -->
<{{$componentElement}} class="{{ $class }}" {!! $attribute !!}>
  <div class="{{$baseClass}}__inner">
    @if($slotHasData)
      {!! $slot !!}
    @endif
  </div>
</{{$componentElement}}>
