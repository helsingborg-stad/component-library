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
          @if($item['usePopoverForChildren'])
            @popover([
              'id' => $item['popoverChildrenId'],
              'relative' => true,
              'verticalPlacement' => 'bottom',
              'horizontalPlacement' => 'left',
              'classList' => [
                $baseClass . '__popover'
              ]
            ])
              @include('Nav.children')
            @endpopover
          @endif

          @includeWhen($item['hasChildren'] && empty($isExtendedDropdown) && !$item['usePopoverForChildren'], 'Nav.children')
          @includeWhen($item['hasChildren'] && !empty($isExtendedDropdown), 'Nav.extended')
      </li>

    @endforeach
</ul>
