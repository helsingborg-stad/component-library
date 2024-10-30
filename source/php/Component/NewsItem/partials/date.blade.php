@typography([
    'element' => 'span',
    'classList' => [$baseClass . '__date']
])
    @icon([
        'icon' => 'calendar_month',
        'size' => 'sm',
        'classList' => [$baseClass . '__date-icon']
    ]) 
    @endicon {{ $date }}
@endtypography