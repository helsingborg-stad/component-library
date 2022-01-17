<!-- field.blade.php -->
<div class="{{$class}}" id="{{ $id }}">

    @if($icon)
        @icon($icon)
        @endicon
    @endif

    @if(!empty($label) && !$hideLabel)
        <label class="{{$baseClass}}__label" for="input_{{ $id }}" id="label_{{ $id }}">{{$label}}</label>
    @endif

    @if($multiline)
        <textarea id="input_{{ $id }}"
            {!! $attribute !!}
            @if($required)
                required
                data-required="1"
                aria-required="true"
            @endif
            placeholder="{{$placeholder}}"
        >{{$value ?? null}}</textarea>
    @else
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
    @endif

    @if ($helperText)
    <small class="{{$baseClass}}__helper">{{$helperText}}</small>
    @endif
</div>
