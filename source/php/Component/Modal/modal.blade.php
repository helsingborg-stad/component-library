<!-- modal.blade.php -->
<dialog id="{{ $id }}" class="{{ $class }}" role="dialog" aria-modal="true"
    aria-labelledby="modal__label__{{ $id }}" {!! $attribute !!}>
    @if ($top)
        <div class="{{ $baseClass }}__top">
            {!! $top !!}
        </div>
    @endif

    <header class="{{ $baseClass }}__header">
        @if ($heading)
            @typography([
            "id" => "modal__label__".$id,
            "variant" => "h2",
            "element" => "h2",
            ])
            {{ $heading }}
            @endtypography
        @endif

        @button([
            'text' => '',
            'icon' => 'close',
            'color' => 'default',
            'style' => 'basic',
            'attributeList' => ['data-close' => ''],
            'classList' => [$baseClass . '__close'],
            'size' => 'xl',
        ])
        @endbutton
    </header>

    <section class="{{ $baseClass }}__content">

        {{-- Previous button --}}
        @if ($navigation)
            @button([
                'text' => '',
                'icon' => 'chevron_left',
                'color' => 'default',
                'style' => 'basic',
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
                'attributeList' => ['data-next' => ''],
                'classList' => [$baseClass . '__next'],
                'label' => 'Slide to next',
                'size' => 'lg',
            ])
            @endbutton
        @endif
    </section>

    @if ($bottom)
        <footer class="{{ $baseClass }}__footer">
            {!! $bottom !!}
        </footer>
    @endif

    @if ($navigation)
        @steppers(
        [
        'type' => 'dots'
        ])
        @endsteppers
    @endif
</dialog>
