<div class="form-group">
	@if($label)
		<label class="control-label">{!! $label !!}</label>
	@endif
	<div class="input{{ $icon ? '-icon' : ''}}">
		@if($icon)
			<i class="fa fa-{{$icon}}"></i>
		@endif
		{!! Form::text($name, $value, $attributes) !!}
	</div>
</div>