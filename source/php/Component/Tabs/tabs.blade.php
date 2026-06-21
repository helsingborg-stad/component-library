<!-- tabs.blade.php -->
@if($tabs)
    <{{$componentElement}} class="{{ $class }}" role="tablist" js-expand-container {!! $attribute !!}>
        <div class="{{ $baseClass }}__header">
            @foreach($tabs as $tab)
                @include('Tabs.partials.tab-button')
            @endforeach
        </div>
        @foreach($tabs as $tab)
            <{{$contentElement}} class="{{$baseClass}}__content" role="tabpanel" id="{{ $baseClass }}__aria-{{ $id }}-{{ $loop->index }}" aria-hidden="{{ $loop->index === 0 ? 'false' : 'true' }}">
                {!! $tab['content'] ?? '' !!}
            </{{$contentElement}}>
        @endforeach
    </{{$componentElement}}>
@else
  <!-- No tabs data -->
@endif
