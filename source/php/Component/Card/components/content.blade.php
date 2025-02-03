@if($collapsible)
<div class="{{$collapsible}}" js-toggle-class="{{$baseClass}}--collapse" js-toggle-item="{{$collpaseID}}">
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