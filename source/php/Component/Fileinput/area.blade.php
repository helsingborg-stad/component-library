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
    <div class="{{$baseClass}}__file-list-inner {{$baseClass}}__file-list-inner--empty">
      <span class="u-color__text--muted">No files selected</span>
    </div>
    <div class="{{$baseClass}}__file-list-inner {{$baseClass}}__file-list-inner--filled">


      @for($index = 0; $index < 3; $index++)


      <div class="{{$baseClass}}__item">
        <div class="{{$baseClass}}__item-icon-wrapper">
          @icon([
            'icon' => 'attach_file',
            'size' => 'sm',
            'classList' => [
              $baseClass . '__item-icon'
            ]
          ])
          @endicon
        </div>
      
        <div class="{{$baseClass}}__item-text">
          <span class="{{$baseClass}}__item-name">Unknown filename</span>
          <span class="{{$baseClass}}__item-size">1MB</span>
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


      @endfor

  </div>
</div>