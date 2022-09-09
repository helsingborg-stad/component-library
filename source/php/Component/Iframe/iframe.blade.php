<!-- iframe.blade.php -->
@if($src)
<iframe id="{{ $id }}" class="{{ $class }}" width="{{$width}}" height="{{$height}}" data-src={{$rc}} src={{$rc}}>
	@if($errorMessage)
		@notice(['isWarning' => true])
		{{$errorMessage}}
		@endnotice
	@endif
</iframe>
@else 
<!-- No iframe source defined -->
@endif
