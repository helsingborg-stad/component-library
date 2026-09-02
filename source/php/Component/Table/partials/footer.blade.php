<div class="{{$baseClass}}__footer">
    <div class="{{$baseClass}}__scroll-indicator-wrapper u-display--none">
        <div class="{{$baseClass}}__scroll-indicator u-display--none" data-js-table-scroll-indicator="1">
        </div>
    </div>
    @if (!empty($caption))
    <p class="c-table__caption"> {{$caption}} </p>
    @endif
</div>