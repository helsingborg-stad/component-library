<{{$componentElement}} class="{{$class}}" {!! $attribute !!}>
    @if(!empty($title))
        @typography([
            'variant' => $titleVariant,
            'element' => 'h2',
            'classList' => [$baseClass . '__title'],
            'autopromote' => true
        ])
            {{ $title }}
        @endtypography
    @endif
</{{$componentElement}}>
