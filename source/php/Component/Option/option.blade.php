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
        aria-labelledby="{{ $labelTextId }}"
    >
    <label for="{{ $id }}" class="c-option__{{$type}}--label">
        <span class="c-option__{{$type}}--label-box"></span>
        @if($hasLabelExtras)
            <span id="label_{{ $id }}" class="c-option__{{$type}}--label-text">
                <span id="{{ $labelTextId }}">{!! $label !!}</span>
                @if($descriptionId)
                    <span id="{{ $descriptionId }}" class="c-option__description">{{ $description }}</span>
                @endif
                @if($stateIndicator)
                    <span id="{{ $stateIndicator['id'] }}" class="{{ $stateIndicator['class'] }}">{{ $stateIndicator['text'] }}</span>
                @endif
            </span>
        @else
            <span id="label_{{ $id }}" class="c-option__{{$type}}--label-text">{!! $label !!}</span>
        @endif
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
