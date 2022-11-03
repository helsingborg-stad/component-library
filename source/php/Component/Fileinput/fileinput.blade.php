<!-- fileinput.blade.php -->

<div class="{{ $class }}" {!! $attribute !!}>

    @if(!empty($label))
        <label class="{{$baseClass}}__label" for="fs_{{ $id }}" id="label_{{ $id }}">
            {{$label}}
            @if($required)
                <span class="u-color__text--danger">*</span></label>
            @endif
        </label>
    @endif

    @if(!empty($description))
        @typography([
            'element' => 'div',
            'classList' => ['text-sm', 'text-dark-gray']
            ])
            {{ $description }}
        @endtypography
    @endif

    <input type="file"
        class="{{ $baseClass }}__input "
        name="{{ $multiple ? $name . '[]' : $name }}"
        id="fs_{{ $id }}"
        accept="{{ $accept }}"
        {{ $multiple ? 'multiple' : '' }}
        @if($required)
            required
            data-required="1"
            aria-required="true"
        @endif
    />

    <label for="fs_{{ $id }}" class="c-button c-button__filled c-button__filled--primary c-button--md {{ $baseClass }}__label">
        
        @icon([
            'icon' => 'file_upload',
            'size' => 'md',
            'color' => 'white'
        ])
        @endicon
        @if(!empty($label))
            <span>
                {{ $beforeLabel }}               
                    {{ $label }}               
                {{ $afterLabel }}
            </span>
        @endif
    </label>

</div>
