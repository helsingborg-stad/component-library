<div class="{{$baseClass}}__expand-button" role="button" >
  @icon([
      'icon' => 'expand_less',
      'size' => 'md',
      'classList' => [$baseClass . '__expand-less-icon'],
      'attributeList' => ['aria-hidden' => 'true']
  ])
  @endicon
  @icon([
      'icon' => 'expand_more',
      'size' => 'md',
      'classList' => [$baseClass . '__expand-more-icon'],
      'attributeList' => ['aria-hidden' => 'false']
  ])
  @endicon
</div>