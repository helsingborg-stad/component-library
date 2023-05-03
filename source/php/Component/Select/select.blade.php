<div class="{{ $class }} c-field">
    @if ($label && $hideLabel)
        <label class="u-sr__only" for="select_{{ $id }}">
            {{ $label }}
        </label>
    @endif

    @if ($label && !$hideLabel)
        <label class="c-field__label" for="select_{{ $id }}">{{ $label }}
            @if ($required)
                <span class="u-color__text--danger">*</span>
            @endif
        </label>
    @endif

    @if (!empty($description))
        @typography([
            'element' => 'div',
            'classList' => ['text-sm', 'text-dark-gray']
        ])
            {{ $description }}
        @endtypography
    @endif

    <div class="u-position--relative">
        <select {!! $attribute !!}>
            @if ($label)
                <option class="c-select__option" value="" {{ $preselected === '' ? 'selected' : '' }}>
                    {!! $label !!}
                </option>
            @endif

            @foreach ($options as $key => $name)
                <option class="c-select__option" value="{!! $key !!}"
                    {{ $preselected === $key || isset($intersection[$key]) ? 'selected' : '' }}>
                    {!! $name !!}
                </option>
            @endforeach

            {!! $slot !!}
        </select>
        <div class="{{ $baseClass }}_focus-styler u-level-top"></div>
        @icon([
            'classList' => ['c-select__icon'],
            'icon' => 'expand_more',
            'size' => 'md'
        ])
        @endicon
    </div>

    <div class="c-select__select-invalid-message" id="error_input_{{ $id }}_message">
        @icon([
            'icon' => 'error',
            'size' => 'sm'
        ])
        @endicon
        <span class="errorText"></span>
    </div>
    
    @if ($helperText)
        <small class="c-field__helper">{{ $helperText }}</small>
    @endif
</div>
