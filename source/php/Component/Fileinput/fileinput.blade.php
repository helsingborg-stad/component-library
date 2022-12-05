<!-- fileinput.blade.php -->

<div class="{{ $class }}" {!! $attribute !!}>
    <label class="{{$baseClass}}__label" for="fs_{{$id}}">{{$label}}{!! $required ? '<span class="u-color__text--danger">*</span>' : '' !!}</label>
    @if(!empty($description))
        @typography([
            'element' => 'div',
            'classList' => ['text-sm', 'text-dark-gray']
            ])
            {{ $description }}
        @endtypography
    @endif

    <input type="file"
        class="{{ $baseClass }}__input "
        name="{{ $multiple ? $name . '[]' : $name }}"
        id="fs_{{ $id }}"
        accept="{{ $accept }}"
        {{ $multiple ? 'multiple' : '' }}
    />

    <label for="fs_{{ $id }}" class="{{ $baseClass }}__button">
        
        @icon([
            'icon' => 'file_upload',
            'size' => 'md',
        ])
        @endicon
        @if(!empty($label) || !empty($buttonLabel))
            <span>
                {{ $beforeLabel }}               
                    {{ !empty($buttonLabel) ? $buttonLabel : $label }}               
                {{ $afterLabel }}
            </span>
        @endif
    </label>

      <ul class="{{ $baseClass }}__files js-form-file-input u-display--none">
            <template>
                <li>
                    @icon([
                        'icon' => 'attach_file',
                        'size' => 'sm'
                    ])
                    @endicon
					<span class="u-strong js-file-input-name"></span> 
                    <span class="js-file-input-size"></span>
                    @icon([
                        'icon' => 'delete',
                        'size' => 'md',
                        'classList' => ['c-fileinput__remove-file']
                    ])
                    @endicon
				</li>
            </template>
        </ul>

</div>
