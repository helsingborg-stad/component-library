<!-- field.blade.php -->
<div class="{{$class}}" id="{{ $id }}">

    @if($icon)
        @icon($icon)
        @endicon
    @endif


    @if(!empty($label))
        <label class="{{$baseClass}}__label" for="input_{{ $id }}" id="label_{{ $id }}">{{$label}}</label>
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


    <small class="{{$baseClass}}__helper">{{$helperText}}</small>
</div>
