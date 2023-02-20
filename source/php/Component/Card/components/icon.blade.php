
@foreach($icons as $icon)
{{-- @php var_dump($icon) @endphp --}}
    @icon([
        'icon' => $icon['icon'],
        'size' => $icon['size'] ?? 'md',
        'filled' => $icon['filled'] ?? false,
        'attributeList' => $icon['iconAttributes'],
        'classList' => $icon['iconClasses'],
    ])
    @endicon
@endforeach