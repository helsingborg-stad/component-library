<!-- testimonials.blade.php -->
@if($testimonials)
<div class="{{$baseClass .'s__wrapper'}} {{$wrapperClassList}}">
    @foreach($testimonials as $testimonial)
        <{{ $componentElement }} id="{{ $id }}" class="{{ $class }}" {!! $attribute !!}>
            @include('Testimonials.partials.item')    
        </{{ $componentElement }}>
    @endforeach

    @if (count($testimonials) > 1)
        @button([
            'style' => 'filled',
            'icon' => 'arrow_back',
            'size' => 'lg',
            'classList' => [
                $baseClass . 's__button'
            ]
        ])
        @endbutton
        @button([
            'style' => 'filled',
            'icon' => 'arrow_forward',
            'size' => 'lg',
            'classList' => [
                $baseClass . 's__button',
            ]
        ])
        @endbutton
    @endif
</div>
@endif
