<div class="{{$class}}" {!! $attribute !!}>
    <select class="c-filterselect__select" multiple>
        @foreach($options as $option)
            <option value="{{$option['value']}}">{{$option['label']}}</option>
        @endforeach
    <select>
    <div class="c-filterselect__dropdown">
        <div class="c-filterselect__expand-button">
            <div class="c-filterselect__checked-items">
            <span class="c-filterselect__placeholder">{{$placeholder}}</span>
            <template>
                <div class="c-filterselect__checked-item">
                    {OPTION_LABEL}
                    @icon([
                        'size' => 'sm',
                        'icon' => 'close',
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
            @foreach($options as $option)
                <div class="c-filterselect__option" js-select-value="{{$option['value']}}">
                    <span class="c-filterselect__option-label">{{$option['label']}}</span>
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