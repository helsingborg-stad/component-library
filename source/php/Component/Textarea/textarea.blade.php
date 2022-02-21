<!-- textarea.blade.php (DEPRECATED IN FAVOR OF FIELD COMPONENT) -->
@field([
    'id'   => $id,
    'attributeList' => array_merge(
        [
            'rows' => $rows ?? 5,
        ],
        $attributeList ?? []
    ),
    'label' => $label,
    'helperText' => $helperText ?? $invalidMessage ?? '',
    'placeholder' => $placeholder ?? '',
    'isValid' => !empty($invalidMessage) ? false : null,
    'multiline'      => true,
])
@endfield