<span class="{{$baseClass}}__label" {{$labelAttributes ?? ""}}>
    @if (!empty($item['truncatedLabel']))
        @tooltip([
            'componentElement' => 'span',
            'typographyElement' => 'span',
            'icon' => false,
            'label' => $item['truncatedLabel'],
            'classList' => ['u-display--inline-block']
        ])
            {!! $item['label']  !!}
        @endtooltip
    @else
        {!! $item['label']  !!}
    @endif
</span>