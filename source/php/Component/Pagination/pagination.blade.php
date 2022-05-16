<!-- pagination.blade.php -->
@if($list)
<{{$componentElement}} id="{{ $id }}" class="{{ $class }}" role="navigation" aria-label="Pagination Navigation" {!! $attribute !!}>
    <{{$listElement}} class="{{$baseClass}}__list">
        
        <{{$listItem}} class="{{$baseClass}}__item--previous {{$baseClass}}__item">
            @button([
            'style' => $buttonStyle,
            'size' => $buttonSize,
            'color' => 'default',
            'icon' => 'chevron_left',
            'attributeList' => [
                'disabled' => $previousDisabled,
                'js-pagination-prev' => ''
            ],
            'href' => $previous,
            ])
            @endbutton
        </{{$listItem}}>

        @includeWhen($firstItem, 'Pagination.Partials.less_indicator')

        <{{$listItem}} class="{{$baseClass}}__page-wrapper">
            <{{$listElement}} class="{{$baseClass}}__pages" js-table-pagination--links>
                @foreach($list as $key => $item)
                    <{{$listItem}} class="{{$baseClass}}__item" js-pagination-index="{{$key + 1}}">
                        @button([
                            'style' => $buttonStyle,
                            'size' => $buttonSize,
                            'color' => $key + 1 == $current ? 'primary' : 'default',
                            'href' => $item['href'],
                            'classList' => [
                                $baseClass . '__link',
                                $key + 1 == $current ? $baseClass.'__item' . $currentClass : ''
                            ],
                            'text' => $key +1
                        ])
                        @endbutton
                    </{{$listItem}}>
                @endforeach
            </{{$listElement}}>
        </{{$listItem}}>

        @includeWhen($lastItem, 'Pagination.Partials.more_indicator')

        <{{$listItem}} class="{{$baseClass}}__item--next {{$baseClass}}__item">
            @button([
                'style' => $buttonStyle,
                'size' => $buttonSize,
                'color' => 'default',
                'icon' => 'chevron_right',
                'attributeList' => [
                    'disabled' => $nextDisabled,
                    'js-pagination-next' => ''
                ],
                'href' => $next
            ])
            @endbutton
        </{{$listItem}}>

    </{{$listElement}}>
</{{$componentElement}}>
@else
<!-- No pagination data -->
@endif