@if($collapsible)
<div class="{{$collapsible}}" data-js-toggle-class="{{$baseClass}}--collapse" data-js-toggle-item="{{$collpaseID}}">
@endif
@if($contentHtmlElement === 'p')
    @typography([ 'classList' => [$baseClass . '__content'], ])
        {!! $content !!}
    @endtypography
@elseif($contentHtmlElement === 'div')
    @element([ 'classList' => [$baseClass . '__content'], ])
        {!! $content !!}
    @endelement
@endif

@if($collapsible)
</div>
@endif