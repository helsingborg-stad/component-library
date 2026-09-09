<span class="{{$baseClass}}__cell-content">
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
            @icon([
                'icon' => 'swap_vert',
                'size' => 'md',
                'classList' => [
                    $baseClass . '__sort-button'
                ]
            ])
            @endicon
        @endif
    @endif
</span>
