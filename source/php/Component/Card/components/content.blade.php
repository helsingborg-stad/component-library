@if($collapsible)
<div class="{{$collapsible}}" data-js-toggle-class="{{$baseClass}}--collapse" data-js-toggle-item="{{$collpaseID}}">
@endif
    @typography([
        'element' => $contentHtmlElement,
        'classList' => [$baseClass . '__content'],
    ])
        {!! $content !!}
    @endtypography
@if($collapsible)
</div>
@endif