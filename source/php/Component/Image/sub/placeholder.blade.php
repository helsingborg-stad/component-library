@if($placeholderEnabled)
  <div class="{{$baseClass}}__placeholder" aria-label="{{$alt}}">
    @if($placeholderIcon)
        @icon([
          'icon' => $placeholderIcon, 
          'size' => $placeholderIconSize,
          'context' => ['component.image.placeholder.icon']
        ])
        @endicon
    @endif
    @if($placeholderText)
        <label class="{{$baseClass}}__placeholder-text">
            {{ $placeholderText }}
        </label>
    @endif
  </div>
@endif