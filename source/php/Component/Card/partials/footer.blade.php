<div class="{{$baseClass}}__footer" js-toggle-class="u-display--none" js-toggle-item="{{$collpaseID}}">
    @if($buttons)
        @foreach($buttons as $button)
            @button($button)
            @endbutton
        @endforeach 
    @endif

    @if($tags)
        @if($buttons) <div class="u-margin__top--2"> @endif
            @tags(['tags' => $tags])
            @endtags
        @if($buttons) </div> @endif
    @endif
</div>