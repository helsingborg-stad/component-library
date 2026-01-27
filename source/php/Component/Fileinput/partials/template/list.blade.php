<template data-js-file="listitem-template">
    <div class="{{$baseClass}}__item" data-js-file="listitem" data-js-file-id="">
        <div class="{{$baseClass}}__item-container">
            <div class="{{$baseClass}}__item-icon-wrapper">
                @icon([
                    'icon' => 'attach_file',
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
            </div>

            <div class="{{$baseClass}}__item-text">
                <span class="{{$baseClass}}__item-name" data-js-file="filename"></span>
                <span class="{{$baseClass}}__item-size" data-js-file="filesize"></span>
            </div>

            <div class="{{$baseClass}}__item-remove" data-tooltip="Remove file">
                @button([
                'size' => 'sm',
                'style' => 'basic',
                'icon' => 'delete',
                'classList' => [
                    $baseClass . '__item-remove-button'
                ],
                'attributeList' => [
                    'aria-label' => $lang->buttonRemoveLabel,
                    'data-js-file' => 'remove'
                ]
                ])
                @endbutton
            </div>
        </div>
    </div>
</template>