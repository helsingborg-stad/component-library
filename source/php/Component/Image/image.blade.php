<!-- image.blade.php -->
@if($src && $placeholderEnabled)
    <figure class="{{ $class }}" {!! $attribute !!}>
        @if($src) 
            @include('Image.sub.image')
            @include('Image.sub.caption')
        @else
            @include('Image.sub.placeholder')
        @endif
    </figure>
@elseif($src && !$placeholderEnabled)
    <figure class="{{ $class }}" {!! $attribute !!}>
        @include('Image.sub.image')
        @include('Image.sub.caption')
    </figure>
@endif

{{-- Modal --}}
@if ($openModal)
    @include('Image.sub.modal')
@endif