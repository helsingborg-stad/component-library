<!-- table.blade.php -->
@if($list)
    <div id="{{ $id }}" class="{{ $class }}" {!! $attribute !!}>
        <div class="{{ $baseClass}}__header">
            @if($title)
                <h2 class="{{$baseClass}}__title">{{$title}}</h2>
            @endif
            @if($fullscreen)
                @icon([
                    'icon'          => 'fullscreen',
                    'size'          => 'md',
                    'color'         => 'primary',
                    'classList'     =>[$baseClass.'__fullscreen'],
                    'attributeList' => ['data-open' => '123']])
                @endicon
            @endif
            @if($filterable)
                @field([
                    'type' => 'text',
                    'attributeList' => [
                        'type' => 'search',
                        'name' => 'search',
                        'js-table-filter-input' => ''
                    ],
                    'classList' => ['u-margin__top--2'],
                    'placeholder' => !empty($labels) && !empty($labels['searchPlaceholder']) ? $labels['searchPlaceholder'] : 'Search',
                    'icon' => ['icon' => 'search']
                ])
                @endfield
            @endif
        </div>

        <div class="{{$baseClass}}__inner">
            <table class="{{$baseClass}}__table">
                @if($showCaption)
                    <caption>{{ $caption }}</caption>
                @endif

                @if($showHeader)
                    <thead class="{{$baseClass}}__head">                                                
                        <tr class="{{$baseClass}}__line">
                            @foreach($headings as $heading)
                                <th scope="col" class="{{$baseClass}}__column {{$baseClass}}__column-{{ $loop->index }}" js-table-sort--btn="{{ $loop->index }}">
                                    {{ $heading }}

                                    @if($isMultidimensional && $loop->index === 0)
                                        @icon([
                                            'icon' => 'chevron_left',
                                            'size' => 'md',
                                            'classList' => ['c-table__collapse-button']
                                        ])
                                        @endicon
                                    @endif
                                    @if($sortable)
                                        @if(($isMultidimensional && $loop->index !== 0) || !$isMultidimensional )                                        
                                            @icon(['icon' => 'swap_vert', 'size' => 'md'])
                                            @endicon
                                        @endif
                                    @endif
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                @endif

                <tbody class="{{$baseClass}}__body" js-sort-data-container js-table-data-container>
                    
                    @foreach($list as $row) 
                        <tr class="{{$baseClass}}__line {{$baseClass}}__line-{{ $loop->index }}" js-table-sort--sortable js-table-filter-item>
                            @foreach($row['columns'] as $column) 
                                @if($isMultidimensional && $loop->first)
                                    <th scope="row" class="{{$baseClass}}__column {{$baseClass}}__column-{{ $loop->index }}" js-table-sort-data="{{ $loop->index }}" js-table-filter-data>
                                        {!! $column !!}
                                    </th>
                                @else
                                    <td scope="row" class="{{$baseClass}}__column {{$baseClass}}__column-{{ $loop->index }}" js-table-sort-data="{{ $loop->index }}" js-table-filter-data>
                                        {!! $column !!}
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>                
            </table>
        </div>
        
        <div class="{{$baseClass}}__footer">

            <div class="{{$baseClass}}__scroll-indicator-wrapper u-display--none">
                <div class="{{$baseClass}}__scroll-indicator u-display--none">
                </div>
            </div>

            @if($pagination)
                <div style="text-align: center;" class="{{$baseClass}}__pagination" js-table-pagination>
                    @button([
                        'style' => 'basic',
                        'color' => 'primary',
                        'icon' => 'chevron_left',
                        'attributeList' => [
                            'js-table-pagination-btn' => 'prev'
                        ],
                    ])
                    @endbutton

                    <div class="u-display--inline-block" js-table-pagination--links>
                        @button([
                            'style' => 'basic',
                            'color' => 'primary',
                            'size' => 'sm',
                            'attributeList' => [
                                'js-table-pagination--link' => '1'
                            ],
                        ])
                        1
                        @endbutton
                    </div>

                    @button([
                        'style' => 'basic',
                        'color' => 'primary',
                        'icon' => 'chevron_right',
                        'attributeList' => [
                            'js-table-pagination-btn' => 'next'
                        ],
                    ])
                    @endbutton
                </div>
            @endif
            <p class="c-table__caption"> {{$caption}} </p>
        </div>
        
    </div>

@else
  <!-- No table list data -->
@endif

@if($fullscreen)
    @include('Table.sub.modal')
@endif



