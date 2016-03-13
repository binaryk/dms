<div class="{{ $class }}">
	@if( ! empty($caption) )
		<label class="control-label" for="{{$name}}">
			@if($icon)
				{!! $icon !!}
			@endif
			{!! $caption !!}
		</label>
    @endif
    {!! 
		Form::textarea($name, $value, $attributes)
    !!}
    @if($help)
		<p class="help-block">{{$help}}</p>
	@endif
</div>