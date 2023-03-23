<div class="{{ $class }}" {!! $attribute !!}>

    @select([
        'multiple' => true,
        'options' => $options,
        'name' => $name,
        'preselected' => $preselected,
        'classList' => ['c-filterselect__select']
    ])
    @endselect
    <div class="c-filterselect__dropdown">
        <div class="c-filterselect__expand-button">
            <div class="c-filterselect__checked-items">
                <span class="c-filterselect__placeholder">{{ $placeholder }}</span>
                <template>
                    <div class="c-filterselect__checked-item">
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
                'classList' => ['c-filterselect__expand-less-icon']
            ])
            @endicon
            @icon([
                'icon' => 'expand_more',
                'size' => 'md',
                'classList' => ['c-filterselect__expand-more-icon']
            ])
            @endicon
        </div>
        <div class="c-filterselect__options">
            @foreach ($options as $value => $name)
                <div class="c-filterselect__option" js-select-value="{{ $value }}">
                    <span class="c-filterselect__option-label">{{ $name }}</span>
                    @icon([
                        'icon' => 'check_box_outline_blank',
                        'size' => 'md',
                        'classList' => ['c-filter__unchecked-icon']
                    ])
                    @endicon
                    @icon([
                        'icon' => 'check_box',
                        'size' => 'md',
                        'classList' => ['c-filter__checked-icon']
                    ])
                    @endicon
                </div>
            @endforeach
        </div>
    </div>
</div>
