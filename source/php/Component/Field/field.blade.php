<!-- field.blade.php -->
<div class="{{$class}}" {!! $attribute !!}>
    
    @if(!empty($label) && !$hideLabel)
        <label class="{{$baseClass}}__label" for="input_{{ $id }}" id="label_{{ $id }}">
            {{$label}}
            @if($required)
                <span class="u-color__text--danger" aria-hidden="true">*</span>
            @endif
        </label>
    @endif
    
    <div class="{{$baseClass}}__inner {{$baseClass}}__inner--{{$type}}">
        
        {{-- Multiline (textarea) --}}
        @if($multiline)

            {{-- Add screen reader, if visible label is hidden. --}}
            @if($hideLabel)
                <label for="input_{{ $id }}" class="u-sr__only">
                    {{$label}}
                </label>
            @endif

            {{-- Do not break into multiple lines, will add space to value. --}}
            <textarea id="input_{{ $id }}" {!! $fieldAttribute !!}>{{ $value }}</textarea>
        @endif

        {{-- Single line (input) --}}
        @if(!$multiline)
            @if(!empty($icon))
                @icon(array_merge(['classList' => [$baseClass . '__icon']], $icon))
                @endicon
            @endif

            @if(!empty($prefix))
                <span class="c-field__prefix">
                    {{$prefix}}
                </span>
            @endif

            {{-- Add screen reader, if visible label is hidden. --}}
            @if($hideLabel)
                <label for="input_{{ $id }}" class="u-sr__only">
                    {{$label}}
                </label>
            @endif
            <input id="input_{{ $id }}" value="{{ $value }}" {!! $fieldAttribute !!}>

            @if(!empty($suffix))
                <span class="{{ $baseClass }}__suffix">{{$suffix}}</span>
            @endif
        @endif

        {{-- Icon when error occurs, otherwise hidden. --}}
        @icon([
            'icon' => 'error_outline',
            'size' => 'md',
            'classList' => [
                $baseClass . '__suffix',
                $baseClass . '__error-icon'
            ],
            'attributeList' => [
                'aria-hidden' => 'true'
            ]
        ])
        @endicon

        {{-- Icon when valid, otherwise hidden. --}}
        @icon([
            'icon' => 'check_circle_outline',
            'size' => 'md',
            'classList' => [
                $baseClass . '__suffix',
                $baseClass . '__success-icon'
            ],
            'attributeList' => [
                'aria-hidden' => 'true'
            ]
        ])
        @endicon

    </div>

    <div class="c-field__error" aria-hidden="true" aria-label="@{{VALIDATION_ERROR_MESSAGE}}">
        @typography(['variant' => 'meta', 'element' => 'span', 'classList' => ['c-field__error-message']])
            @{{VALIDATION_ERROR_MESSAGE}}
        @endtypography
    </div>

    @if ($helperText)
        <small class="{{$baseClass}}__helper">
            {{$helperText}}
        </small>
    @endif
</div>
