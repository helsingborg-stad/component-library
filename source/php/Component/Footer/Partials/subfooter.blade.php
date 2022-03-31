<div class="{{ $baseClass }}__subfooter {{$subfooterClass}}">
    <div class="o-container">
        <ul class="{{$baseClass}}__subfooter__list">
            @foreach($subFooterContent as $index => $item)
                <li>
                    <strong>{{ $item['title'] }}</strong> {{ $item['content'] }}
                </li>
            @endforeach
        </ul>
    </div>
</div>