{{-- accordion.blade.php --}}
<div class="{{ $class }}" {!! $attribute !!}>
    @includeWhen(!empty($heading), 'Accordion.partials.heading')
    @foreach($list as $item)
        @accordion__item($item)
        @endaccordion__item
    @endforeach
    {!! $slot !!}
</div>
