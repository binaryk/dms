<div class="form-group">
	@if($label)
		<label class="control-label">{!! $label !!}</label>
	@endif
	{!! Form::select($name, $options, $value, $attributes) !!}
</div>