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
                        'data-js-table-filter-input' => '1'
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
            <table class="{{$baseClass}}__table" data-js-table-element="1">
                @if(!empty($showCaption) && !empty($caption))
                    <caption>{{ $caption }}</caption>
                @endif

                @if ($showHeader && !empty($headings))
                    @table__head([])
                        @table__row([])
                            @foreach($headings as $heading)
                                @table__cell([
                                    'componentElement' => 'th',
                                    'index' => $loop->index,
                                ])
                                    @include('Table.partials.heading-cell')
                                @endtable__cell
                            @endforeach
                        @endtable__row
                    @endtable__head
                @endif
                @if(!empty($list))
                    @table__body([])
                        @foreach($list as $row)
                            @table__row([
                                'index' => $loop->index,
                                'isSummary' => $showSum && $loop->last
                            ])
                                @foreach($row['columns'] as $column)
                                    @table__cell([
                                        'componentElement' => ($loop->first ? 'th' : 'td'),
                                        'index' => $loop->index,
                                    ])
                                        @includeWhen($loop->first, 'Table.partials.body-heading-cell')
                                        @includeWhen(!$loop->first, 'Table.partials.body-cell')
                                    @endtable__cell
                                @endforeach
                            @endtable__row
                        @endforeach
                    @endtable__body
                @endif 
            </table>
        </div>
        @include('Table.partials.footer')
    </div>
@endcard
@else
  <!-- No table list data -->
@endif

@if(!empty($fullscreen))
    @include('Table.sub.modal')
@endif