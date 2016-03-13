@if( ! empty($caption) )
	<label class="control-label" for="{{$name}}">
		@if($icon)
			{!! $icon !!}
		@endif
		{!! $caption !!}
	</label>
@endif
<div class="{{ $class }}">

    {!! 
    	Form::checkbox($name, $value, $value == 1, $attributes)
    !!}
    <label for="{{ $name }}">{{ $label }}</label>
    @if($help)
		<p class="help-block">{{$help}}</p>
	@endif
</div>