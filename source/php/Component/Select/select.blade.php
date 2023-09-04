<div class="c-field {{ $class }}" {!! $attribute !!}>
    @if (!empty($label) && !empty($hideLabel))
        <label class="u-sr__only" for="select_{{ $id }}">
            {{ $label }}
        </label>
    @endif

    @if (!empty($label) && empty($hideLabel))
        <label class="c-field__label" for="select_{{ $id }}">
            {{ $label }}
            @if (!empty($required))
                {{--
                    Field has aria attribute required, this will be read as required.
                    Aria hidden in place here, to avoid duplicate notations in screenreader.
                --}}
                <span class="u-color__text--danger" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    @if (!empty($description))
        @typography([
            'element' => 'div',
            'classList' => [
                $baseClass . '__description',
                'text-sm', 
                'text-dark-gray'
            ]
        ])
            {{ $description }}
        @endtypography
    @endif
    <div class="{{ $baseClass }}__field-container">
        
        <select {!! $selectAttributes !!} class="{{ $baseClass }}__select-element" tabindex="-1">
    
            @if ($preselected !== '' && empty($isMultiSelect))
                <option class="c-select__select-option" value="">{{$placeholder ? $placeholder : ""}}</option>
            @endif

            @foreach ($options as $key => $name)
                <option class="c-select__select-option" value="{!! $key !!}" {{ $isSelected($key, false) }}>
                    {!! $name !!}
                </option>
            @endforeach

            @if(!empty($slot))
                {!! $slot !!}
            @endif
        </select>
        @include('Select.partials.focus')
        @include('Select.partials.expand')
        @includeWhen($clearButtonEnabled, 'Select.partials.clear')
        @include('Select.partials.action')
    </div>
    @include('Select.partials.dropdown')
    @include('Select.partials.error')

    @if (!empty($helperText))
        <small class="c-field__helper">{{ $helperText }}</small>
    @endif
    <template>
        @include('Select.partials.dropdown_item', [
            'value' => 'false', 
            'name' => '{OPTION_NAME}'
        ])
    </template>
</div>

