@link([
    'href' => (isset($row['href']) && !empty($row['href']) ? $row['href'] : false),
    'classList' => [$baseClass . '__cell-content'],
])
    {!! $column !!}
@endlink