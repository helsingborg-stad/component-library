<div class="{{$baseClass}} c-field">
    @if(!empty($label) && !$hideLabel)
        <label class="{{$baseClass}}__label c-field__label" for="{{ $id }}-input" id="label_{{ $id }}">
            {{$label}}
            @if($required)
                <span class="u-color__text--danger">*</span></label>
            @endif
        </label>
    @endif
    <div id="{{$id}}" class="{{$baseClass}}__preview">
        <div class="{{$baseClass}}__image material-icons {{$aspectRatioClass}} is-empty"></div>
        <span></span>
    </div>
    @fileinput([
        'id' => $id . '-input',
        'name' => $name,
        'display' => 'area',
        'multiple' => $multiple,
        'label' => __('Upload an image', 'event-integration'),
        'accept' => "image/gif, image/jpeg, image/png",
        'classList' => ['u-margin__top--1'],
        'required' => $required,
        'attributeList' => [
            'required' => 'required',
            'data-image-preview' => $id,
            'data-max-file-size' => $maxFileSize ?? 0,
            'data-max-width' => $maxWidth ?? 0,
            'data-max-height' => $maxHeight ?? 0
        ]
    ])
    @endfileinput
    @if ($helperText)
        <small class="{{$baseClass}}__helper c-field__helper">{!!$helperText!!}</small>
    @endif
</div>
