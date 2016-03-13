<button 
	type="button" 
	id="{{ $id }}" 
	class="{{ $class }}"
	@if( isset($data) && is_array($data) )
		@foreach($data as $key => $value)
			data-{{$key}} = "{{$value}}"
		@endforeach
	@endif
	@if( isset($aria) && is_array($aria) )
		@foreach($aria as $key => $value)
			aria-{{$key}} = "{{$value}}"
		@endforeach
	@endif
>
	<span class="ladda-label">
	@if($icon)
		{!! $icon !!}
	@endif 
	{!! $caption !!}
	</span>
</button>