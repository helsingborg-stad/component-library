<!-- image.blade.php -->

<style>
    .c-image {
        container-type: inline-size;
    }

    .c-image__image {
        @supports (container-type: inline-size) {
            display: none;
        }
    }
</style>

<figure class="{{ $class }}" {!! $attribute !!}>
    @if($src) 

        <!-- Image-->
        @foreach($containerQueryData as $item)
            <img 
                style="display: none;" 
                loading="lazy" 
                class="{{$item['uuid']}} {{$baseClass}}__image {{$baseClass}}__image--no-container-query" 
                src="{{$item['url']}}" alt="{{$alt}}"
            />
            <!-- Display the image, if the container query matches -->
            <style>
                @container {{$item['media']}} {
                    .{{$item['uuid']}} {
                        display: block !important;
                    }
                }
            </style>
        @endforeach

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