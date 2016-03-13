<li id="{{ $itemid }}" class="{{ $itemclass }}">
	<a 
		id="{{ $anchorid }}" 
		class="{{ $anchorclass }}" 
		href="{{ $href }}" 
		@if( isset($data) && is_array($data) )
			@foreach($data as $key => $value)
				data-{{$key}} = "{{$value}}"
			@endforeach
		@endif
	>
		{!! $caption !!}
	</a>
</li>