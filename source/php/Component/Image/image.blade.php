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