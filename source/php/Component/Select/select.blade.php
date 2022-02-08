<div class="c-select__container c-field">
    @if($label)
        <label for="{{ $id }}" class="c-field__label">{{$label}}</label>
    @endif
    
    <div class="u-position--relative">
        <select id="{{ $id }}" class="{{ $class }}" {!! $attribute !!}>
            @if($label)
            <option class="c-select__option" {{ $preselected === '' ? 'selected' : ''}} value="">{!!$label!!}</option>
            @endif


            @foreach ($options as $value => $name)
                <option class="c-select__option" value="{!!$value!!}" {{ $preselected === $value ? 'selected' : ''}}>{!!$name!!}</option>
            @endforeach

            {!! $slot !!}
        </select>
        @icon([
            'classList' => [
                'c-select__icon'
            ],
            'icon' => 'expand_more',
            'size' => 'md',
        ])
        @endicon
    </div>

    <div id="error_input_{{ $id }}_message" class="c-field__input-invalid-message">
        @icon([
            'icon' => 'error',
            'size' => 'sm'
        ])
        @endicon
        <span class="errorText"></span>
    </div>
    @if ($helperText)
        <small class="c-field__helper">{{$helperText}}</small>
    @endif
</div>