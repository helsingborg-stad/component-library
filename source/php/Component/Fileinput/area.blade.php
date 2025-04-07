<div class="{{ $baseClass }}__area" data-js-file="area">
  @typography([
    'classList' => ['c-field__description', $baseClass . '__description', 'u-margin--0']
  ])
    {{ $description }}
  @endtypography

  @button([
    'icon' => 'file_upload',
    'text' => 'Select File',
    'size' => 'md',
    'style' => 'basic',
    'classList' => [
      $baseClass . '__button',
      'u-margin__top--3',
      'js-file-input-button'
    ],
    'attributeList' => [
      'data-js-file' => 'button'
    ]
  ])
  @endbutton

  <div class="{{$baseClass}}__file-list">
    
    <template data-js-file="listitem-template">
      <div class="{{$baseClass}}__item" data-js-file="listitem">
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
          <span class="{{$baseClass}}__item-name" data-js-file="filename">Unknown filename that is truncated if too long text</span>
          <span class="{{$baseClass}}__item-size" data-js-file="filesize">1MB</span>
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
              'aria-label' => 'Remove file',
              'data-js-file' => 'remove'
            ]
          ])
          @endbutton
        </div>
      </div>
    </template>
</div>