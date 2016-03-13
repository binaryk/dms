<div class="{{ $class }}">
	@if($caption)
		<label>{{$caption}}</label>
	@endif
	{!! Form::select($name, $options, $value, $attributes) !!}
</div>