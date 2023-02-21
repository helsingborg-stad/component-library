<!-- modal.blade.php -->
<dialog class="{{ $class }}" aria-modal="true" aria-labelledby="modal__label__{{ $id }}"
    {!! $attribute !!}>
    <div class="{{ $baseClass }}__header">
        @if ($heading)
            @typography([
                'id' => 'modal__label__' . $id,
                'variant' => 'h2',
                'element' => 'h2',
                'attributeList' => ['tabindex' => '1'],
                'classList' => [$baseClass . '__heading']
            ])
                {{ $heading }}
            @endtypography

            @button([
                'text' => '',
                'icon' => 'close',
                'color' => 'default',
                'style' => 'basic',
                'attributeList' => ['data-close' => ''],
                'classList' => [$baseClass . '__close'],
                'size' => 'lg',
            ])
            @endbutton
        @else
            @button([
                'text' => '',
                'icon' => 'close',
                'color' => 'default',
                'style' => 'basic',
                'attributeList' => [
                    'data-close' => '',
                    'style' => 'right:10px;top:10px;z-index:999;',
                ],
                'classList' => [$baseClass . '__close', 'u-position--absolute'],
                'size' => 'lg',
            ])
            @endbutton
        @endif
    </div>
    <section class="{{ $baseClass }}__content" tabindex="2">

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
    </section>

    @if ($bottom)
        <div class="{{ $baseClass }}__footer">
            {!! $bottom !!}
        </div>
    @endif

    @if ($navigation)
        @steppers([
            'type' => 'dots'
        ])
        @endsteppers
    @endif
</dialog>
