<!-- fileinput.blade.php -->

<div class="{{ $class }}" {!! $attribute !!}>

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
        <span>
            {{ $beforeLabel }}
                {{ $label }}
            {{ $afterLabel }}
        </span>
    </label>

</div>
