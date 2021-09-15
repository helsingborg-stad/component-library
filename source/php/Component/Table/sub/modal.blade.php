@modal([
    
    'isPanel' => true,
    'id' => '123',
    'overlay' => 'dark',
    'animation' => 'scale-up'
])
    
   @table(
    [
        'list' => $list, 
        'headings' => $headings, 
        'title' => $title,
        'filterable'    => $filterable,
        'sortable'      => $sortable,
        'pagination'    => $pagination,
        'showSum'       => $showSum,
        'fullscreen'    => false,
        'boxShadow'     => false
    ])
   @endtable
   
@endmodal