{{-- Accordion Item --}}
<{{$sectionElement}} class="{{$class}}" {!! $attribute !!}">
    <{{$sectionHeadingElement}} class="{{$baseClass}}__button" aria-label="{{$ariaLabel}}" aria-controls="{{ $baseClass }}__aria-{{ $id }}" aria-expanded="false" js-expand-button href="#{{$id}}">
        <div class="{{$baseClass}}__button-wrapper {{$headingType}} " tabindex="-1">
            
            {!!$beforeHeading!!}
            
            @if (is_array($heading))
                @foreach($heading as $headingItem)
                    <span class="{{$baseClass}}__button-column">{{$headingItem}}</span>
                @endforeach
            @else
            @typography([
                'element' => 'h3',
                'variant' => 'h4'
            ])
                {!! $heading !!}
            @endtypography
            @endif
            
            @if($taxonomyPosition === 'top' && $taxonomy > 0)
                @tags([
                    'tags' => $taxonomy
                ])
                @endtags
            @endif

            {!!$afterHeading!!}

            @icon(['icon' => $icon, 'size' => 'md', 'classList' => [$baseClass . '__icon', $baseClass . '__icon--' . $icon]])
            @endicon
        </div>

        </{{$sectionHeadingElement}}>

            <{{$sectionContentElement}} class="{{$baseClass}}__content" id="{{ $baseClass }}__aria-{{ $id }}" aria-hidden="true">
            
            {!!$beforeContent!!}
                {!! $slot !!}
            {!!$afterContent!!}

        @if($taxonomyPosition === 'below' && $taxonomy > 0)
            @tags([
                'tags' => $taxonomy
            ])
            @endtags
        @endif
    </{{$sectionContentElement}}>
</{{$sectionElement}}>
{{-- End Accordion Item --}}