<!-- fileinput.blade.php -->
<div class="c-field {{ $class }}" {!! $attribute !!}>

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
        id="fs_{{ $id }}"
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
