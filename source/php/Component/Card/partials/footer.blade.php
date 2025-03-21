<div class="{{$baseClass}}__footer" data-js-toggle-class="u-display--none" data-js-toggle-item="{{$collpaseID}}">
    @if($buttons)
        @foreach($buttons as $button)
            @button($button)
            @endbutton
        @endforeach 
    @endif
    
    @if($tags)
        @tags([
            'compress' => 4, 
            'tags' => $tags, 
            'format' => false,
            'classList' => ($buttons) ? ['u-margin__top--2'] : []
            ])
        @endtags
    @endif
</div>