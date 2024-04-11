<!-- option.blade.php -->
<div class="{{$class}} c-option__{{$type}}">
    <input {!! $attribute !!} type="{{$type}}"
        class="c-option__{{$type}}--hidden-box"
        placeholder="{{$label}}"
        value="{{$value}}"
        @if($required)
            required
            data-required="1"
            aria-required="true"
            data-js-required
        @endif
        @if($checked !== false) checked @endif
        aria-checked="{{$checked ? 'true' : 'false'}}"
        tabindex="0"
        label="{{$label}}"
        aria-labelledby="label_{{ $id }}"
    />
    <label for="{{ $id }}" class="c-option__{{$type}}--label">
        <span class="c-option__{{$type}}--label-box"></span>
        <span id="label_{{ $id }}" class="c-option__{{$type}}--label-text">{!! $label !!}</span>
    </label>
    <div id="error_input_{{ $id }}_message" class="c-option__input-invalid-message">
        @icon([
            'icon' => 'error',
            'size' => 'sm'
        ])
        @endicon
        <span class="errorText"></span>
    </div>
</div>