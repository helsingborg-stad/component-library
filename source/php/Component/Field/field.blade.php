<!-- field.blade.php -->
<div class="{{$class}}" id="{{ $id }}">
    @if(!empty($label) && !$hideLabel)
        <label class="{{$baseClass}}__label" for="input_{{ $id }}" id="label_{{ $id }}">{{$label}}</label>
    @endif
    
    <div class="{{$baseClass}}__inner">
        @if(!empty($icon))
            @icon(array_merge(['classList' => [$baseClass . '__icon']], $icon))
            @endicon
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
        @if(!empty($suffix))<div class="c-field__suffix-wrapper">@endif

            <input id="input_{{ $id }}"
                style="flex: 1"
                value="{{$value}}"
                {!! $attribute !!}
                @if($required)
                    required
                    data-required="1"
                    aria-required="true"
                @endif
                placeholder="{{$placeholder}}"
            />

        @if(!empty($suffix))<span class="c-field__suffix">{{$suffix}}</span></div>@endif
    @endif

            <input id="input_{{ $id }}"
                style="flex: 1"
                value="{{$value}}"
                {!! $attribute !!}
                @if($required)
                    required
                    data-required="1"
                    aria-required="true"
                @endif
                placeholder="{{$placeholder}}"
            />

        @if(!empty($suffix))<span class="c-field__suffix">{{$suffix}}</span></div>@endif
    @endif
    </div>
    @if ($helperText)
        <small class="{{$baseClass}}__helper">{{$helperText}}</small>
    @endif
</div>
