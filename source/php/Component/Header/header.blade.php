<!-- header.blade.php -->
<{{$componentElement}} id="{{ $id }}" class="{{ $class }}" {!! $attribute !!}>

  @if($slotHasData)
    {!! $slot !!}
  @endif
  
</{{$componentElement}}>