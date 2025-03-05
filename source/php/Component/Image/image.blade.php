<!-- image.blade.php -->
@if($placeholderEnabled)
    <figure class="{{ $class }}" {!! $attribute !!}>
        @if($src) 
            @include('Image.sub.image')
            @include('Image.sub.caption')
        @else
            @include('Image.sub.placeholder')
        @endif
    </figure>
@else
    @if($src) 
        <figure class="{{ $class }}" {!! $attribute !!}>
            @include('Image.sub.image')
            @include('Image.sub.caption')
        </figure>
    @endif
@endif

@if($containerQueryData)
    <!-- Image styles -->
    <style>
    @foreach($containerQueryData as $item)
        @foreach(['landscape', 'portrait'] as $dimension)
        @container {{$item['media'][$dimension]}} and (orientation: {{$dimension}}) {
            .{{$baseClass}}.{{$baseClass}}--container-query .{{$baseClass}}--{{$item['uuid']}} {display: block;}
        }
        @endforeach
    @endforeach
    </style>
@endif