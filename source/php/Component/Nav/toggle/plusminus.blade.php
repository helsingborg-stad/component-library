@if ($item['children'] && $includeToggle && $item['style'] == 'default')
    @button([
        'classList' => [
            $baseClass . '__toggle',
            is_bool($item['children']) ? 'js-async-children' : '',
        ],
        'style' => 'basic',
        'size' => 'md',
        'pressed' => $item['active'] ? 'true' : 'false',
        'attributeList' => [
            'aria-label' => $getExpandLabel($item['label'], $expandLabel),
        ],
    ])
    <span class="@php echo $baseClass . '__toggle__plus-minus-symbol' @endphp">
      <span></span>
      <span></span>
    </span>
    @endbutton
@endif
