<li class="{{$baseClass}}__option {{ $isSelected($value, true) ? 'is-selected' : '' }}" data-js-dropdown-option="{{!empty($value) ? $value : ''}}" role="option" aria-selected="{{ $isSelected($value, true) ? 'true' : 'false' }}" tabindex="0">
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
          'aria-hidden' => isset($isSelected) || $isSelected($value, true) ? 'false' : 'true'
        ]
    ])
    @endicon
    <span class="{{$baseClass}}__option-label">{{ $name }}</span>
</li>