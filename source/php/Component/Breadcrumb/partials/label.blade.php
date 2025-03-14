<span class="{{$baseClass}}__label" {{$labelAttributes ?? ""}} @if(!empty($item['truncatedLabel'])) data-tooltip="{{$item['label']}}" @endif>
    @if (!empty($item['truncatedLabel']))
        {!! $item['truncatedLabel'] !!}
    @else
        {!! $item['label']  !!}
    @endif
</span>