@modal([
    'isPanel' => true,
    'id' => 'modal-' . $uid,
    'overlay' => 'dark',
    'animation' => 'scale-up',
    'heading' => $title,
    'classList' => [
        'c-table__modal'
    ],
])
   @table([
        'list'          => $list, 
        'headings'      => $headings, 
        'filterable'    => $filterable,
        'sortable'      => $sortable,
        'showSum'       => $showSum,
        'fullscreen'    => false,
        'includePaper'  => false,
    ])
   @endtable
@endmodal