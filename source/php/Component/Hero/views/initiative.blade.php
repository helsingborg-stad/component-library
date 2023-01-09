
{{-- Add modifier --overflow to get two different looks. --}}
{{-- $background does not exist at the moment. Can be of any value accepted by the background property --}}
    <div class="{{$baseClass}}__background" style="{{$customData['background']}}">
    </div>
        <div class="o-container ">
              @group([
                'wrap' => 'wrap',
                'classList' => [$baseClass . '__content', 'o-grid', 'u-flex-direction--row--reverse']
            ])
                <div class="{{$baseClass}}__group">
                    @image([
                        'src' => $customData['image'],
                        'classList' => ['u-margin__bottom--0', $baseClass . '__group-image']
                    ])
                    @endimage
                </div>
                <div class="{{$baseClass}}__group">
                @group([
                    'justifyContent' => 'center',
                    'direction' => 'vertical',
                    'classList' => [$baseClass . '__group-content']
                ])

                    @if($customData['contentSlotHasData'])
                        {!! $content !!}
                    @endif
                @endgroup
                </div>
            @endgroup
        </div>

