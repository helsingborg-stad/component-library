<!-- pagination.blade.php -->
@if($list)
  <{{$elementType}} class="{{ $class }}" {!! $attribute !!}>
     
      @foreach($list as $item)
        {{--- List item ---}}
        @if(!empty($item['href']))
        <li class="{{$baseClass}}__item {{$baseClass}}__item-{{ $loop->index }}">
          <a href="{{ $item['href'] }}" aria-label="{{ $item['label'] }}" class="{{$baseClass}}__link">
            @group([])
              @if (!empty($item['icon']))
              @icon($item['icon'])
              @endicon
              @endif
              <span class="{{$baseClass}}__label">
                  {{ $item['label'] }}
                @if($icon)
                  @icon(['icon' => $icon['icon'] ?? 'arrow_forward', $icon['size'] ?? 'size' => 'lg'])
                  @endicon
                @endif
              </span>
            @endgroup
          </a>
          @include('Listing.sub') {{--- Recursive action ---}}
        </li>
        @else
        <li class="{{$baseClass}}__item {{$baseClass}}__item-{{ $loop->index }}">
          @group([])
            @if (!empty($item['icon']))
              @icon($item['icon'])
              @endicon
            @endif
            <span class="{{$baseClass}}__label">
              @if(isset($item['label']) && !empty($item['label']))
                {!! $item['label'] !!}
              @endif
            </span>
          @endgroup
          @include('Listing.sub') {{--- Recursive action ---}}
        </li>
        @endif
      @endforeach

  </{{$elementType}}>
@else
<!-- No pagination data -->
@endif