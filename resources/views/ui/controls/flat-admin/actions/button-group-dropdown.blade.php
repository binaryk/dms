<div class="{{ $class }}">
	{!! $button->render() !!}
	<ul class="dropdown-menu" role="menu">
		@foreach($items as $key => $item)
			{!! $item->render() !!}
		@endforeach
	</ul>
</div>