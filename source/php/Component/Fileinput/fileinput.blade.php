<!-- fileinput.blade.php -->
<div class="c-field {{ $class }}" {!! $attribute !!}>
    @element([
        'componentElement' => 'template',
        'attributeList' => [
            'data-js-file' => 'notice-template',
            'data-js-upload-error-message' => $uploadErrorMessage,
            'data-js-upload-error-message-min-files' => $uploadErrorMessageMinFiles,
        ]
    ])
        @notice([
            'type' => 'danger',
            'icon' => [
                'icon' => 'error',
                'size' => 'lg',
            ]
        ])
        <!-- Message -->
        @endnotice
    @endelement
    @if(!empty($label))
        @element([
            'componentElement' => 'label',
            'classList' => [
                'c-field__label', 
                $baseClass . '__label'
            ],
            'attributeList' => [
                'for' => 'input_' . $id,
                'id' => 'label_' . $id,
                'data-js-file' => 'label'
            ]
        ])
            {{$label}}

            @if($required)
                <span class="u-color__text--danger" aria-hidden="true">*</span>
            @endif
        @endelement
    @endif

    <!-- Actual input -->
    <input type="file"
        class="{{ $baseClass }}__input"
        name="{{ $multiple ? $name . '[]' : $name }}"
        id="input_{{ $id }}"
        accept="{{ $accept }}"
        {{ $multiple ? 'multiple' : '' }}
        {!! !empty($required) ? 'required="true" data-js-required' : '' !!}
        data-js-file="input"
        aria-hidden="true"
        tabindex="-1"
    >

    <div class="{{$baseClass}}__inner {{$baseClass}}__inner--area">
        @include('Fileinput.area')
    </div>
</div>
