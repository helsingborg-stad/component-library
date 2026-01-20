@typography([ 
    'element' => 'div', 
    'classList' => [ $baseClass . '__search-no-results' ],
    'attributeList' => ['aria-hidden' => 'true']
])
    {{ $searchNoResultsText }}
@endtypography
