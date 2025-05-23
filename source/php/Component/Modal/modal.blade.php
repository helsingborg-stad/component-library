<!-- modal.blade.php -->
<dialog class="{{ $class }}" aria-labelledby="modal__label__{{ $id }}" {!! $attribute !!}>

    <div class="{{ $baseClass }}__header">
        @if ($heading)
            @typography([
                "id" => "modal__label__".$id,
                "variant" => "h2",
                "element" => "h2",
                'attributeList' => ['tabindex' => '1'],
                'classList' => [$baseClass . '__heading']
            ])
                {{ $heading }}
            @endtypography
        @endif
            @button([
                'text' => $closeButtonText,
                'icon' => 'close',
                'color' => 'default',
                'style' => 'basic',
                'attributeList' => ['data-close' => ''],
                'classList' => [$baseClass . '__close'],
                'size' => 'lg',
            ])
            @endbutton
    </div>

    <div class="{{ $baseClass }}__content" tabindex="2">

        {{-- Previous button --}}
        @if ($navigation)
            @button([
                'text' => '',
                'icon' => 'chevron_left',
                'color' => 'default',
                'style' => 'basic',
                'ariaLabel' => $ariaLabels->prev,
                'attributeList' => ['data-prev' => ''],
                'classList' => [$baseClass . '__prev'],
                'label' => 'Slide to previous',
                'size' => 'lg',
            ])
            @endbutton
        @endif

        {!! $slot !!}

        {{-- Next button --}}
        @if ($navigation)
            @button([
                'text' => '',
                'icon' => 'chevron_right',
                'color' => 'default',
                'style' => 'basic',
                'ariaLabel' => $ariaLabels->next,
                'attributeList' => ['data-next' => ''],
                'classList' => [$baseClass . '__next'],
                'label' => 'Slide to next',
                'size' => 'lg',
            ])
            @endbutton
        @endif
    </div>

    @if ($bottom)
        <div class="{{ $baseClass }}__footer">
            {!! $bottom !!}
        </div>
    @endif

    @if ($navigation)
        @steppers(
        [
        'type' => 'dots'
        ])
        @endsteppers
    @endif
</dialog>
