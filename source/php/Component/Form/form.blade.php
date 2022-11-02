<!-- form.blade.php -->
<form class="{{$class}}" {!! $attribute !!} method="{{$method}}" action="{{$action}}">

    @notice([
        'id' => $id . '-validation-error',
        'type' => 'danger',
        'message' => [
            'text' => '@{{FORM_VALIDATION_ERROR_MESSAGE}}',
            'title' => '@{{FORM_VALIDATION_ERROR_TITLE}}'
        ],
        'icon' => [
            'name' => 'report',
            'size' => 'md',
            'color' => 'black'
        ],
        'classList' => [
            $baseClass . '__notice-failed',
            'u-margin__bottom--4',
            //'u-display--none'
        ],
        'attributeList' => [
            'aria-hidden' => 'true',
        ]
    ])
    @endnotice

    @notice([
        'id' => $id . '-validation-sucess',
        'type' => 'success',
        'message' => [
            'text' => '@{{FORM_VALIDATION_SUCCESS_MESSAGE}}',
            'title' => '@{{FORM_VALIDATION_SUCCESS_TITLE}}'
        ],
        'icon' => [
            'name' => 'check',
            'size' => 'md',
            'color' => 'black'
        ],
        'classList' => [
            $baseClass . '__notice-success',
            'u-margin__bottom--4',
            //'u-display--none'
        ],
        'attributeList' => [
            'aria-hidden' => 'true',
        ]
    ])
    @endnotice

    {!! $slot !!}
</form>
