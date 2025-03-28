@element([
    'classList' => [
        $baseClass . '__icon'
    ]
])
    @if($icon)
      @icon($icon)
      @endicon
    @else
      @icon([
        'icon' => 'placeholder',
        'size' => 'md',
        'attributeList' => [
          'aria-hidden' => 'true',
          'aria-label' => ''
        ],
        'classList' => [
          'u-visibility--hidden'
        ]
      ])
      @endicon
    @endif
@endelement