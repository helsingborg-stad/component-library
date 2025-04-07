<!-- fileinput.blade.php -->
<div class="c-field {{ $class }}" {!! $attribute !!}>

    @if(!empty($label))
        @element([
            'componentElement' => 'label',
            'classList' => [
                'c-field__label', 
                $baseClass . '__label'
            ],
            'attributeList' => [
                'for' => 'input_' . $id,
                'id' => 'label_' . $id
            ]
        ])
            {{$label}}

            @if($required)
                <span class="u-color__text--danger" aria-hidden="true">*</span>
            @endif
        @endelement
    @endif

    <div class="{{$baseClass}}__inner {{$baseClass}}__inner--{{$display}}">
        @include('Fileinput.' . $display)
    </div>

    @if(!empty($description) && $display !== 'area')
        @typography([
            'classList' => ['c-field__description', $baseClass . '__description']
        ])
        {{$description}}
        @endtypography
    @endif
</div>
