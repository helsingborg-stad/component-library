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
    @if($preview)
        @include('Fileinput.partials.template.preview')
    @else
        @include('Fileinput.partials.template.list')
    @endif
  </div>

  <div
    class="{{$baseClass}}__filecounter"
    data-js-file="counter"
    data-counter-current="0"
    data-counter-max="{{$filesMax}}"
    aria-hidden="true"
    aria-live="polite"
  >/</div>
</div>