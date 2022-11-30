<!-- video.blade.php -->
@if($formats)
    <video class="{{ $class }}" width="{{$width}}" height="{{$height}}" {{$controls}} {{$muted}} {{$autoplay}} {!! $attribute !!}>

        @if($formats)
            @foreach($formats as $format)
                <source class="{{ $baseClass }}__source" src="{{$format['src']}}" type="video/{{$format['type']}}">
            @endforeach
        @endif
        @if($subtitles)
            @foreach($subtitles as $subtitle) 
                    @if($loop->first)
                        <track src="{{$subtitle['file']}}" label="{{$subtitle['language']['label']}}" kind="captions" srclang="{{$subtitle['language']['value']}}" default>
                    @else
                        <track src="{{$subtitle['file']}}" label="{{$subtitle['language']['label']}}" kind="captions" srclang="{{$subtitle['language']['value']}}">
                    @endif
            @endforeach
        @endif

        @if($errorMessage)
            @notice(['isWarning' => true])
            {{$errorMessage}}
            @endnotice
        @endif
            
    </video>
@else 
<!-- No video data defined -->
@endif