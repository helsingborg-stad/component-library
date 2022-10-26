<!-- header.blade.php -->
<{{$componentElement}} class="{{ $class }}" {!! $attribute !!}>

  @if($slotHasData)
    {!! $slot !!}
  @endif
  
</{{$componentElement}}>