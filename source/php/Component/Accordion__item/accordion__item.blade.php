{{-- accordion__item.blade.php --}}
<details class="{{ $class }}" {!! $attribute !!}>
    @element([
        'componentElement' => 'summary',
        'classList' => [$baseClass . '__heading']
    ])
        @foreach($heading as $headingItem)
            @typography([
                'element' => 'span',
                'variant' => 'h4',
                'classList' => [$baseClass . '__heading-item'],
                'attributeList' => ['role' => 'heading', 'aria-level' => '3']
            ])
                {{ $headingItem }}
            @endtypography
        @endforeach

        @icon([
            'icon' => 'keyboard_arrow_down',
            'size' => 'md',
            'classList' => [$baseClass . '__icon']
        ])
        @endicon
    @endelement
    @element([
        'componentElement' => 'div',
        'classList' => [$baseClass . '__content']
    ])
        {{ $content }}
        {{ $slot }}
    @endelement
</details>
