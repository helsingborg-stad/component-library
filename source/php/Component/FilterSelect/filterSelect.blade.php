<div class="{{ $class }}" {!! $attribute !!}>

    @select([
        'multiple' => true,
        'options' => $options,
        'name' => $name,
        'preselected' => $preselected,
        'classList' => [$baseClass . '__select']
    ])
    @endselect
    <div class="{{$baseClass}}__dropdown">
        <div class="{{$baseClass}}__expand-button">
            <div class="{{$baseClass}}__checked-items">
                <span class="{{$baseClass}}__placeholder">{{ $placeholder }}</span>
                <template>
                    <div class="{{$baseClass}}__checked-item">
                        {OPTION_LABEL}
                        @icon([
                            'size' => 'sm',
                            'icon' => 'close'
                        ])
                        @endicon
                    </div>
                </template>
            </div>
            @icon([
                'icon' => 'expand_less',
                'size' => 'md',
                'classList' => [$baseClass . '__expand-less-icon']
            ])
            @endicon
            @icon([
                'icon' => 'expand_more',
                'size' => 'md',
                'classList' => [$baseClass . '__expand-more-icon']
            ])
            @endicon
        </div>
        <div class="{{$baseClass}}__options">
            @foreach ($options as $value => $name)
                <div class="{{$baseClass}}__option" js-select-value="{{ $value }}">
                    <span class="{{$baseClass}}__option-label">{!! $name !!}</span>
                    @icon([
                        'icon' => 'check_box_outline_blank',
                        'size' => 'md',
                        'classList' => [$baseClass . '__unchecked-icon']
                    ])
                    @endicon
                    @icon([
                        'icon' => 'check_box',
                        'size' => 'md',
                        'classList' => [$baseClass . '__checked-icon']
                    ])
                    @endicon
                </div>
            @endforeach
        </div>
    </div>
</div>
