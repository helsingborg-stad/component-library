<!-- image.blade.php -->
<figure class="{{ $class }}" {!! $attribute !!}>
    @if($src) 
        <img src="{{$src}}" alt="{{$alt}}" {!! $imgAttributes !!} />
        @if(($caption || $byline) && !$removeCaption)
            <figcaption>
                @if($caption)
                    <span class="{{$baseClass}}__caption">{{ $caption }}</span><br>
                @endif
                @if($byline)
                    <span class="{{$baseClass}}__byline">{{ $byline }}</span>
                @endif
            </figcaption>
        @endif
    @else
        
        <div class="{{$baseClass}}__placeholder" aria-label="{{$alt}}">

            @if($placeholderIcon)
                @icon(['icon' => $placeholderIcon, 'size' => $placeholderIconSize])
                @endicon
            @endif

            @if($placeholderText)
                <label class="{{$baseClass}}__placeholder-text">
                    {{ $placeholderText }}
                </label>
            @endif
            
        </div>
        
    @endif
</figure>

@if ($openModal)
    @include('Image.sub.modal')
@endif
