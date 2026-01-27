<template data-js-file="listitem-template">
    <div class="{{$baseClass}}__item" data-js-file="listitem" data-js-file-id="">
    <div class="{{$baseClass}}__item-preview" data-js-file="preview">
            @icon([
            'size' => 'xl',
            'icon' => 'attach_file',
            'classList' => [
                $baseClass . '__attachment-icon'
            ],
            'attributeList' => [
                'aria-hidden' => 'true',
                'data-js-file' => 'icon'
            ]
        ])
        @endicon
    </div>
        <div class="{{$baseClass}}__info-container">
            <span class="{{$baseClass}}__item-name" data-js-file="filename"></span>
            <span class="{{$baseClass}}__item-size" data-js-file="filesize"></span>
        </div>

        <div class="{{$baseClass}}__item-remove" data-tooltip="Remove file">
            @button([
            'size' => 'xs',
            'style' => 'filled',
            'color' => 'primary',
            'classList' => [
                $baseClass . '__item-remove-button'
            ],
            'attributeList' => [
                'aria-label' => $lang->buttonRemoveLabel,
                'data-js-file' => 'remove'
            ],
            ])
            @icon([
                'icon' => 'delete',
                'size' => 'sm',
                'classList' => [
                    $baseClass . '__item-icon'
                ],
                'attributeList' => [
                    'aria-hidden' => 'true',
                    'data-js-file' => 'icon'
                ]
            ])
            @endicon
            @endbutton
        </div>
    </div>
</template>