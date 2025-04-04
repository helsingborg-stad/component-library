<div class="{{ $baseClass }}__area js-file-input-area" data-js-file="area">
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
</div>