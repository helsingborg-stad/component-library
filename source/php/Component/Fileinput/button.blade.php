<input type="file"
    class="{{ $baseClass }}__input"
    name="{{ $multiple ? $name . '[]' : $name }}"
    id="fs_{{ $id }}"
    accept="{{ $accept }}"
    {{ $multiple ? 'multiple' : '' }}
    {!! !empty($required) ? 'required="true" data-js-required' : '' !!}
    data-js-file="input"
>

@button([
    'componentElement' => 'label',
    'style' => 'filled',
    'text' => $buttonLabel ?: $label,
    'icon' => 'file_upload',
    'attributeList' => [
        'for' => 'fs_' . $id
    ],
    'classList' => [
        $baseClass . '__button',
        'js-file-input-button'
    ],
    'attributeList' => [
      'data-js-file' => 'button'
    ]
])
@endbutton

<template id="rowinput_template_{{$id}}">
  @collection__item([
    'icon' => 'attach_file',
    'attributeList' => [
      'data-js-file' => 'listitem'
    ],
  ])
    @typography(['classList' => ['c-fileinput__file-name', 'js-file-input-name'], 'attributeList' => ['data-js-file' => 'name']])
      Unknown filename
    @endtypography
    @typography(['variant' => 'meta', 'classList' => ['c-fileinput__file-size', 'js-file-input-size'],'attributeList' => ['data-js-file' => 'size']])
      NaN MB
    @endtypography

    @slot('secondary')
      <div data-tooltip="Remove file" class="c-fileinput__remove-file">
        @button([
          'size' => 'md',
          'style' => 'basic',
          'icon' => 'delete',
          'classList' => ['c-fileinput__remove-file'],
          'attributeList' => [
            'aria-label' => 'Remove file',
            'data-js-file' => 'remove'
          ]
        ])
        @endbutton
      </div>
    @endslot
  @endcollection__item
</template>

@collection([
    'id' => "rowinput_template_{{$id}}", 
    'bordered' => true,
    'compact' => true,
    'classList' => [
      'c-fileinput__files-list'
    ],
    'attributeList' => [
      'data-js-file' => 'list'
    ]
])
  Här fanns det ingen fil!
@endcollection