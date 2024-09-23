<!-- image.blade.php -->

<style>
    .c-image {
        @supports (container-type: inline-size) {
            container-type: inline-size;
        }
    }

    .c-image__image {
        @supports (container-type: inline-size) {
            display: none;
        }
    }

    .c-image__image:last-of-type {
        @supports not (container-type: inline-size) {
            display: block;
        }
    }
</style>

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
                        .{{$baseClass}}--{{$item['uuid']}} {display: block;}
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