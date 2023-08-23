<!-- Visual dropdown list -->
<div class="{{$baseClass}}__dropdown" data-js-dropdown-element="true" aria-hidden="true">
  <ul class="{{$baseClass}}__options u-unlist u-padding--0 u-margin--0" role="listbox">
      @foreach ($options as $value => $name)
          <li class="{{$baseClass}}__option {{ $isSelected($value, true) ? 'is-selected' : '' }}" data-js-dropdown-option="{{$value}}" role="option" aria-selected="{{ $isSelected($value, true) ? 'true' : 'false' }}" tabindex="0">
              @icon([
                  'icon' => $itemStateIcons->inactive,
                  'size' => $iconSize,
                  'classList' => [
                    $baseClass . '__option-icon',
                    $baseClass . '__unchecked-icon'
                  ],
                  'attributeList' => [
                    'aria-hidden' => $isSelected($value, true) ? 'true' : 'false'
                  ]
              ])
              @endicon
              @icon([
                  'icon' => $itemStateIcons->active,
                  'size' => $iconSize,
                  'classList' => [
                    $baseClass . '__option-icon',
                    $baseClass . '__checked-icon'
                  ],
                  'attributeList' => [
                    'aria-hidden' => $isSelected($value, true) ? 'false' : 'true'
                  ]
              ])
              @endicon
              <span class="{{$baseClass}}__option-label">{{ $name }}</span>
          </li>
      @endforeach
  </ul>
</div>