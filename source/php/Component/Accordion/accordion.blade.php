<!-- accordion.blade.php -->
@if($list)
    <{{$componentElement}} class="{{ $class }}" js-expand-container {!! $attribute !!}>
        @foreach($list as $section)
            <{{$sectionElement}} class="{{$baseClass}}__section">
                @include('Accordion.partials.heading-button')

                <{{$sectionContentElement}} class="{{$baseClass}}__content" id="{{ $baseClass }}__aria-{{ $id }}-{{ $loop->index }}" aria-hidden="true">
                    
                    {!!$beforeContent!!}

                    {!! $section['content'] !!}

                    {!!$afterContent!!}

                    @if($taxonomyPosition === 'below' && $taxonomy > 0)
                        @tags([
                            'tags' => $taxonomy
                        ])
                        @endtags
                    @endif

                </{{$sectionContentElement}}>

            </{{$sectionElement}}>
        @endforeach
    </{{$componentElement}}>

@elseif($slotHasData)
    <{{$componentElement}} class="{{ $class }}" js-expand-container {!! $attribute !!}>
        {!! $slot !!}
    </{{$componentElement}}>
@else
    <!-- No accordion list data -->
@endif
