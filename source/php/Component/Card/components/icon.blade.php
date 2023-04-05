@inlineCssWrapper([
    'styles' => ['background-color' => $icon['backgroundColor'], 'display' => 'flex'],
    'classList' => [$icon['backgroundColor'] ? '' : 'u-color__bg--primary', 'u-rounded--full', 'u-detail-shadow-3']
])
    @icon($icon)
    @endicon
@endinlineCssWrapper