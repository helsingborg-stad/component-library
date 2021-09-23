@modal([
    
    'isPanel' => true,
    'id' => '123',
    'overlay' => 'dark',
    'animation' => 'scale-up',
    'heading' => $title
])
    
   @table(
    [
        'list' => $list, 
        'headings' => $headings, 
        'filterable'    => $filterable,
        'sortable'      => $sortable,
        'pagination'    => $pagination,
        'showSum'       => $showSum,
        'fullscreen'    => false,
        'boxShadow'     => false
    ])
   @endtable
   
@endmodal