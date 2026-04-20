{{-- Accordion Item --}}
<{{$sectionElement}} class="{{$class}}" {!! $attribute !!}">
            @include('Accordion__item.partials.heading-button')

            <{{$sectionContentElement}} class="{{$accordionClass}}__content" id="{{ $accordionClass }}__aria-{{ $id }}" aria-hidden="true">
            
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