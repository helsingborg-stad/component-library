<!-- nav.blade.php -->
@if ($items) 
  <ul class="{{$class}}" {!! $attribute !!}>
    @foreach ($items as $item)
      
      <li id="{{$id}}-{{$item['id']}}-{{$loop->index}}__item" class="{{ $itemClass($item) }}" {!! $buildAttributes($item['attributeList']) !!}>
        
        {{-- Nav item --}}
        @if($allowStyle)
          @includeIf('Nav.style.' . $item['style'])
        @else
          @includeIf('Nav.style.default')
        @endif

        {{-- Children list --}}
        @include('Nav.children')

      </li>

    @endforeach
  </ul>
@endif