<div id="{{ $id }}" class="{{ $class }}" {!! $attribute !!}>
    <div class="{{$baseClass}}__container splide__track">
        <div class="{{$baseClass}}__inner splide__list" js-slider-inner>
            {{ $slot }}
        </div>
    </div>
</div>