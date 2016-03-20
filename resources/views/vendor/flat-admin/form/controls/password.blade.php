<div class="form-group">
	@if($label)
		<label class="control-label visible-ie8 visible-ie9">{!! $label !!}</label>
	@endif
	<div class="input-icon">
		<i class="fa fa-lock"></i>
		{!! Form::password($name, $attributes) !!}
	</div>
</div>