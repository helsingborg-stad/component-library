<!-- notice.blade.php -->
<div class="{{ $class }}" {!! $attribute !!} aria-labelledby="notice__text__{{ $id }}">
    
    {{-- notice__ico --}}
    @if($icon)
        <span class="{{$baseClass}}__icon">
            @icon(['icon' => $icon['name'], 'size' => 'md'])
            @endicon
        </span>
    @endif
    
    {{-- notice__title --}}
    @if($message['title'])
        @typography([
            "variant" => "h4",
            "element" => "h4",
            'classList' => [
                $baseClass . '__title'
            ]
        ])
            {{ $message['title'] }}
        @endtypography
    @endif

    {{-- notice__text --}}
    <span id="notice__text__{{ $id }}" for="" class="{{$baseClass}}__message">
        @if(isset($message['text']))
            {!! $message['text'] !!}
        @endif
        {!! $slot !!}
    </span>

    {{-- notice__action --}}
    @if($action)
        <div class="{{$baseClass}}__action">
            @button([
                'text' => $action['label'] ?? 'Undefined',
                'href' => $action['url'] ?? '#',
                'style' => 'outlined',
                'color' => 'default',
                'size' => 'md',
                'classList' => [
                    $baseClass . '__button'
                ],
            ])
            @endbutton
        </div>
    @endif

    {{-- notice__dismiss --}}
    @if($dismissable)
        <div class="{{$baseClass}}__dismiss">
            @button([
                'icon' => 'close',
                'style' => 'basic',
                'size' => 'md',
                'color' => 'default',
                'classList' => [
                    $baseClass . '__dismiss'
                ],
                'attributeList' => [
                    'data-dismiss' => 'notice',
                    'aria-label' => 'Close'
                ]
            ])
            @endbutton
        </div>
    @endif
</div>