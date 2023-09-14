<!-- table.blade.php -->
@if($list)
@card([])
    <div class="{{ $class }}" {!! $attribute !!}>
        @if(!empty($title) || !empty($fullscreen) || !empty($filterable))
        <div class="{{ $baseClass}}__header">
            @if(!empty($title))
            
                @typography([
                    "variant" => "h4",
                    "element" => "h2",
                    "classList" => [$baseClass . '__title']
                ])
                    {{ $title }}
                @endtypography
            @endif

            @if(!empty($fullscreen))
                @icon([
                    'icon'          => 'fullscreen',
                    'size'          => 'md',
                    'color'         => 'primary',
                    'classList'     =>[$baseClass.'__fullscreen', 'u-display--none@xs', 'u-display--none@sm'],
                    'attributeList' => ['data-open' => 'modal-' . $uid]])
                @endicon
            @endif

            @if(!empty($filterable))
                @field([
                    'type' => 'search',
                    'name' => 'search',
                    'attributeList' => [
                        'js-table-filter-input' => ''
                    ],
                    'classList' => ($fullscreen||$title) ? ['u-margin__top--2'] : [],
                    'placeholder' => !empty($labels) && !empty($labels['searchPlaceholder']) ? $labels['searchPlaceholder'] : 'Search',
                    'icon' => ['icon' => 'search']
                ])
                @endfield
            @endif

        </div>
        @endif

        <div class="{{$baseClass}}__inner">
            <table class="{{$baseClass}}__table">
                @if(!empty($showCaption) && !empty($caption))
                    <caption>{{ $caption }}</caption>
                @endif

                @if($showHeader)
                    <thead class="{{$baseClass}}__head">                                                
                        <tr class="{{$baseClass}}__line">
                            @if(!empty($headings))
                                @foreach($headings as $heading)
                                    <th scope="col" class="{{$baseClass}}__column {{$baseClass}}__column-{{ $loop->index }}" js-table-sort--btn="{{ $loop->index }}">
                                        
                                        <span class="{{$baseClass}}__column-content">

                                            <!-- Heading label -->
                                            <span class="{{$baseClass}}__heading">
                                                {{ $heading }}
                                            </span>

                                            <!-- Collapse button -->
                                            @if(!empty($isMultidimensional) && $loop->index === 0)
                                                @icon([
                                                    'icon' => 'chevron_left',
                                                    'size' => 'md',
                                                    'classList' => [$baseClass . '__collapse-button']
                                                ])
                                                @endicon
                                            @endif

                                            <!-- Sort button -->
                                            @if(!empty($sortable))
                                                @if((!empty($isMultidimensional) && $loop->index !== 0) || empty($isMultidimensional))                                        
                                                    @icon(['icon' => 'swap_vert', 'size' => 'md', 'classList' => [$baseClass . '__sort-button']])
                                                    @endicon
                                                @endif
                                            @endif

                                        </span>

                                    </th>
                                @endforeach
                            @endif
                        </tr>
                    </thead>
                @endif

                <tbody class="{{$baseClass}}__body" js-sort-data-container js-table-data-container>
                    @if(!empty($list)) 
                        @foreach($list as $row) 
                            <tr class="{{$baseClass}}__line {{$baseClass}}__line-{{ $loop->index }}" js-table-sort--sortable js-table-filter-item>
                                @if(!empty($row['columns'])) 
                                    @foreach($row['columns'] as $column) 
                                        @if($loop->first)
                                            <th scope="row" class="{{$baseClass}}__column {{$baseClass}}__column-{{ $loop->index }}" js-table-sort-data="{{ $loop->index }}" js-table-filter-data>
                                                @link([
                                                    'href' => (isset($row['href']) && !empty($row['href']) ? $row['href'] : false),
                                                    'classList' => [$baseClass . '__column-content'],
                                                ])
                                                    {!! $column !!}
                                                @endlink  
                                            </th>
                                        @else
                                            <td scope="row" class="{{$baseClass}}__column {{$baseClass}}__column-{{ $loop->index }}" js-table-sort-data="{{ $loop->index }}" js-table-filter-data>
                                                <span class="{{$baseClass}}__column-content">
                                                    {!! $column !!}
                                                </span>
                                            </td>
                                        @endif
                                    @endforeach
                                @endif
                            </tr>
                        @endforeach
                    @endif
                </tbody>                
            </table>
        </div>
        
        <div class="{{$baseClass}}__footer">
            <div class="{{$baseClass}}__scroll-indicator-wrapper u-display--none">
                <div class="{{$baseClass}}__scroll-indicator u-display--none">
                </div>
            </div>
            @if (!empty($caption))
            <p class="c-table__caption"> {{$caption}} </p>
            @endif
        </div>

    </div>
@endcard
@else
  <!-- No table list data -->
@endif

@if(!empty($fullscreen))
    @include('Table.sub.modal')
@endif