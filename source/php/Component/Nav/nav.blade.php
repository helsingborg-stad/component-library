<!-- nav.blade.php -->
@if ($items) 
  <ul class="{{$class}}" {!! $attribute !!}>
    @foreach ($items as $item)
      
      <li id="{{$id}}-{{$item['id']}}-{{$loop->index}}__item" class="{{ $itemClass($item, $direction) }}" {!! $buildAttributes($item['attributeList']) !!}>
        
        <div class="{{$baseClass}}__item-wrapper">
          {{-- Nav item --}}
          @if($allowStyle)
            @includeIf('Nav.style.' . $item['style'])
          @else
            @includeIf('Nav.style.default')
          @endif

          {{-- Children list --}}
          @includeWhen($item['hasToggle'], 'Nav.toggle')
        </div>

        {{-- Children list --}}
        @element([
            'classList' => [
                $baseClass . '__child-container',
            ]
        ])
          @includeWhen($item['hasChildren'] && empty($isExtendedDropdown), 'Nav.children')
          @includeWhen($item['hasChildren'] && !empty($isExtendedDropdown), 'Nav.extended')
        @endelement

      </li>

    @endforeach
  </ul>
@endif