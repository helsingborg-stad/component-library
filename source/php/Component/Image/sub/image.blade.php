@if($containerQueryData) 
    @foreach($containerQueryData as $item)
        <img 
            loading="lazy" 
            class="{{$baseClass}}__image {{$baseClass}}--{{$item['uuid']}}" 
            src="{{$item['url']}}"
            alt="{{$alt}}"
            style="{{$focus}}"
            {!! $imgAttributes !!}
        />
        <style>
            @container {{$item['media']}} {
                .{{$baseClass}}.{{$baseClass}}--container-query .{{$baseClass}}--{{$item['uuid']}} {display: block;}
            }
        </style>
    @endforeach
@else
    <img
        loading="lazy" 
        class="{{$baseClass}}__image" 
        src="{{$src}}" 
        alt="{{$alt}}"
        {!! $imgAttributes !!}
    />
@endif