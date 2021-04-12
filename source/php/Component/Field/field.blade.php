<!-- field.blade.php -->
@if($showLabel)
<label id="label_{{ $id }}" class="c-field__text--label" for="input_{{ $id }}">{{$label}}</label>
@endif

<div id="{{ $id }}" class="{{$class}}">

    @if($icon)
        @icon($icon)
        @endicon
    @endif

    <input id="input_{{ $id }}"
           value="{{$value}}"
           {!! $attribute !!}
           @if($required)
               required
               data-required="1"
               aria-required="true"
           @endif
           placeholder="{{$placeholder}}"
    />
    <label class="c-field__text--placeholder">
        {{$placeholder}}
    </label>

    <div id="error_input_{{ $id }}_message" class="c-field__input-invalid-message">
        @icon([
            'icon' => 'error',
            'size' => 'sm'
        ])
        @endicon
        <span class="errorText"></span>
    </div>
</div>
