<!-- form.blade.php -->
<form class="{{$class}}" {!! $attribute !!} method="{{$method}}" action="{{$action}}">

    @if($errorMessage)
        @notice([
            'id' => $id . '-validation-error',
            'type' => 'danger',
            'message' => [
                'text' => $errorMessage
            ],
            'icon' => [
                'name' => 'report',
                'size' => 'md',
                'color' => 'black'
            ],
            'classList' => [
                $baseClass . '__notice-failed',
                'u-margin__bottom--4'
            ],
            'attributeList' => [
                'aria-hidden' => 'true',
            ]
        ])
        @endnotice
    @endif

    @if($validateMessage)
        @notice([
            'id' => $id . '-validation-sucess',
            'type' => 'success',
            'message' => [
                'text' => $validateMessage,
            ],
            'icon' => [
                'name' => 'check',
                'size' => 'md',
                'color' => 'black'
            ],
            'classList' => [
                $baseClass . '__notice-success',
                'u-margin__bottom--4'
            ],
            'attributeList' => [
                'aria-hidden' => 'true',
            ]
        ])
        @endnotice
    @endif

    {!! $slot !!}
</form>
