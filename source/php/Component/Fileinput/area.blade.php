<div class="{{ $baseClass }}__area" data-js-file="area">

  @if($description)
    @typography([
      'classList' => ['c-field__description', $baseClass . '__description', 'u-margin__top--1', 'u-margin__bottom--3'],
    ])
      {{ $description }}
    @endtypography
  @endif

  <!-- This button is used to trigger the file input -->
  @button([
    'icon' => 'file_upload',
    'text' => $buttonLabel,
    'size' => 'md',
    'style' => 'basic',
    'classList' => [
      $baseClass . '__button',
      'js-file-input-button'
    ],
    'attributeList' => [
      'data-js-file' => 'button',
      'aria-live' => 'polite',
    ]
  ])
  @endbutton

  <!-- This button is used to illustrate drag and drop, it has no function -->
  @button([
    'icon' => 'place_item',
    'text' => $buttonDropLabel,
    'size' => 'md',
    'style' => 'basic',
    'classList' => [
      'js-file-input-drop'
    ],
    'attributeList' => [
      'data-js-file' => 'drop',
      'aria-hidden' => 'true'
    ]
  ])
  @endbutton

  <div class="{{$baseClass}}__file-list" data-js-file="list">
    
    <template data-js-file="listitem-template">
      <div class="{{$baseClass}}__item" data-js-file="listitem" data-js-file-id="">
        <div class="{{$baseClass}}__item-icon-wrapper">
          @icon([
            'icon' => 'attach_file',
            'size' => 'sm',
            'classList' => [
              $baseClass . '__item-icon'
            ],
            'attributeList' => [
              'aria-hidden' => 'true',
              'data-js-file' => 'icon'
            ]
          ])
          @endicon
        </div>
      
        <div class="{{$baseClass}}__item-text">
          <span class="{{$baseClass}}__item-name" data-js-file="filename"></span>
          <span class="{{$baseClass}}__item-size" data-js-file="filesize"></span>
        </div>

        <div class="{{$baseClass}}__item-remove" data-tooltip="Remove file">
          @button([
            'size' => 'sm',
            'style' => 'basic',
            'icon' => 'delete',
            'classList' => [
              $baseClass . '__item-remove-button'
            ],
            'attributeList' => [
              'aria-label' => $buttonRemoveLabel,
              'data-js-file' => 'remove'
            ]
          ])
          @endbutton
        </div>
      </div>
    </template>
</div>

<div
  class="{{$baseClass}}__filecounter"
  data-js-file="counter"
  data-counter-current="0"
  data-counter-max="{{$filesMax}}"
  aria-hidden="true"
  aria-live="polite"
>/</div>