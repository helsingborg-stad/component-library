<!-- breadcrumb.blade.php -->
@if($list)
<{{$componentElement}} class="{{ $class }}" aria-label="{{$label}}" {!! $attribute !!}>
  @if($prefixLabel)
    <span class="{{$baseClass}}__prefix u-sr__only">
      {{$prefixLabel}}
    </span>
  @endif
  <{{$listType}} class="{{$baseClass}}__list unlist">
    @foreach($list as $item) 
      <{{$listItemType}} data-level="{{ $loop->depth }}" class="{{$baseClass}}__item {{$baseClass}}__item_{{ $loop->index }} {{$baseClass}}__item_depth-{{ $loop->depth }}">
        
        @if(isset($item['icon']) && !empty($item['icon']))
          @icon(['icon' => $item['icon']])
          @endicon
        @endif
  
        @if($loop->last) 
          <span class="{{$baseClass}}__label" aria-current="page">
            {!! $item['label']  !!}
          </span>
        @else 

          @if($item['href'])
            <a class="{{$baseClass}}__link" href="{{ $item['href'] }}">
              <span class="{{$baseClass}}__label">
                {!! $item['label']  !!}
              </span>
            </a>
          @else
            <span class="{{$baseClass}}__link {{$baseClass}}__link--unclickable">
              <span class="{{$baseClass}}__label">
                {!! $item['label']  !!}
              </span>
            </span>
          @endif
        @endif

      </{{$listItemType}}>
    @endforeach
  </{{$listType}}>
</{{$componentElement}}>
@else
<!-- No breadcrumb data -->
@endif