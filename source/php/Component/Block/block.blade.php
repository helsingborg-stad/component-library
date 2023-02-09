<!-- block.blade.php -->
<{{ $componentElement }} class="{{$class}}" @if($image && isset($image['src']))style="background-image:url('{{$image['src']}}');" @endif{!! $attribute !!}>

    @if($date && $dateBadge)
        @datebadge(['date' => $date, 'classList' => ['u-position--absolute', 'u-margin--3', 'u-fixed--top-left']])
        @enddatebadge
    @endif

    @if(!$slotHasData)
        <div class="{{$baseClass}}__body">

            @if($date && !$dateBadge)
                @tags([
                    'tags' => [
                        ['label' => $date]
                    ],
                    'beforeLabel' => '',
                    'format' => false
                ])
                @endtags
            @endif

            @if($meta)
                <div class="{{$baseClass}}__meta">
                    @tags([
                        'tags' => $meta,
                        'beforeLabel' => '',
                        'format' => false
                    ])
                    @endtags
                </div>
            @endif

            @if($heading)
                @typography([
                    'element'   => 'h2',
                    'variant'   => 'h2',
                    'classList' => [
                        $baseClass."__heading"
                    ]
                ])
                    {!! $heading !!}
                @endtypography
            @endif

            @if($content)
                @typography([
                    'element'   => 'p',
                    'variant'   => 'p',
                    'classList' => [
                        $baseClass."__content"
                    ]
                ])
                    {!! $content !!}
                @endtypography
            @endif

        </div>
    @endif
    {!! $slot !!}
</{{ $componentElement }}>
