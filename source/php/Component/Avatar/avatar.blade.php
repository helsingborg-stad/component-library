<!-- avatar.blade.php -->
@if($displayAvatar)

    <div class="{{ $class }}" {!! $attribute !!}>
        
        {{-- If the avatar has an image --}}
        @if($image)
            @image(
                [
                    'src' => $image,
                    'classList' => [$baseClass.'__image'],
                    'alt' => $label,
                    'attributeList' => [
                        'aria-label' => $label
                    ],
                    'cover' => true
                ]
            )
            @endimage
        @endif

        {{-- If the avatar has an icon --}}
        @if($icon)
            <span class="{{$baseClass}}__icon" aria-label="{{ $label }}">
                @icon(
                    [
                        'icon' => $icon['name'],
                        'classList' => ["c-icon--size-".$icon['size']]
                    ]
                )
                @endicon
            </span>
        @endif

        {{-- If the avatar has initials --}}
        @if($initials)
            <svg class="{{$baseClass}}__initials" aria-label="{{ $label }}" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <text font-size="380" y="50%" x="50%" fill="#fff" dominant-baseline="middle" text-anchor="middle" alignment-baseline="central">{{$initials}}</text>
            </svg>
        @endif
        
    </div>

@endif