<div class="{{ $class }}">
	@if( ! empty($caption) )
		<label class="control-label {!! @$lclass !!}" for="{{$name}}">
			@if(isset($icon))
				{!! $icon !!}
			@endif
			{!! $caption !!}
		</label>
    @endif
   	<div class="{!! @$wrapper !!}">
	{!!
       Form::textarea($name, $value, $attributes)
   !!}
	</div>
    @if($help)
		<p class="help-block">{{$help}}</p>
	@endif
</div>