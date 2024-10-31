@typography([
    'element' => 'span',
    'classList' => [$baseClass . '__read-time']
])
    @icon([
        'icon' => 'timer',
        'size' => 'sm',
        'classList' => [$baseClass . '__read-time-icon']
    ]) 
    @endicon {{ $readTime }}
@endtypography