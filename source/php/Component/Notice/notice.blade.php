<!-- notice.blade.php -->
<div id="{{ $id }}" class="{{ $class }}" {!! $attribute !!} aria-labelledby="notice__text__{{ $id }}">
    
    <!-- notice__ico -->
    @if($icon)
        <span class="{{$baseClass}}__icon">
            @icon(['icon' => $icon['name'], 'size' => 'md'])
            @endicon
        </span>
    @endif
    
    <!-- notice__title -->
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

    <!-- notice__text -->
    <span id="notice__text__{{ $id }}" for="" class="{{$baseClass}}__message">
        @if(isset($message['text']))
            {!! $message['text'] !!}
        @endif
        {!! $slot !!}
    </span>

</div>