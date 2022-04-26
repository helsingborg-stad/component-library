<!-- field.blade.php -->
<div class="{{$class}}" id="{{ $id }}">
    @if(!empty($label) && !$hideLabel)
        <label class="{{$baseClass}}__label" for="input_{{ $id }}" id="label_{{ $id }}">
            {{$label}}
            @if($required)
                <span class="u-color__text--danger">*</span></label>
            @endif
        </label>
    @endif
    
    <div class="{{$baseClass}}__inner {{$baseClass}}__inner--{{$type}}">
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

            <i class="c-icon c-field__suffix material-icons c-field__error-icon" translate="no" role="img">error_outline</i>
        @else
            @if(!empty($icon))
                @icon(array_merge(['classList' => [$baseClass . '__icon']], $icon))
                @endicon
            @endif
            @if(!empty($prefix))
                <span class="c-field__prefix">
                    {{$prefix}}
                </span>
            @endif

            <input id="input_{{ $id }}"
                type="{{$type}}"
                value="{{$value}}"
                {!! $attribute !!}
                @if($required)
                    required
                    data-required="1"
                    aria-required="true"
                @endif
                placeholder="{{$placeholder}}"
            />

            @if(!empty($suffix))
                <span class="c-field__suffix">{{$suffix}}</span>
            @endif
            
            <i class="c-icon c-field__suffix material-icons c-field__error-icon" translate="no" role="img">error_outline</i>
        @endif
    </div>
    @if ($helperText)
        <small class="{{$baseClass}}__helper">{{$helperText}}</small>
    @endif
</div>
