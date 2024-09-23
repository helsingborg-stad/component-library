<!-- image.blade.php -->
@if($containerQueryData) 
    <style>
        @supports (container-type: inline-size) {
            .c-image.c-image--container-query {
                container-type: inline-size;
                background-size: cover;
            }
            .c-image.c-image--container-query .c-image__image {
                display: none;
            }
        }
        @supports not (container-type: inline-size) {
            .c-image.c-image--container-query .c-image__image:not(:last-of-type) {
                display: none;
            }
        }
    </style>
@endif

<figure class="{{ $class }}" {!! $attribute !!}>
    @if($src) 

        <!-- Image-->
        @if($containerQueryData) 
            @foreach($containerQueryData as $item)
                <img 
                    loading="lazy" 
                    class="{{$baseClass}}__image {{$baseClass}}--{{$item['uuid']}}" 
                    src="{{$item['url']}}"
                    alt="{{$alt}}"
                    {{$imgAttributes}}
                />
                <style>
                    @container {{$item['media']}} {
                        .{{$baseClass}}.{{$baseClass}}--container-query .{{$baseClass}}--{{$item['uuid']}} {display: block;}
                    }
                </style>
            @endforeach
        @else
            <img
                loading="lazy" 
                class="{{$baseClass}}__image" 
                src="{{$src}}" 
                alt="{{$alt}}"
                {{$imgAttributes}}
            />
        @endif

        <!-- Caption and byline -->
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
        <!-- Placeholder -->
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