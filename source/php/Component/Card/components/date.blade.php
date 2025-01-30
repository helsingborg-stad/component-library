@typography(['variant' => 'meta', 'element' => 'span', 'classList' => [$baseClass . '__date']])
    @icon(['icon' => 'date_range', 'size' => 'sm'])
    @endicon
    @date([
        'action' => 'formatDate',
        'timestamp' => $date,
    ])
    @enddate
@endtypography
