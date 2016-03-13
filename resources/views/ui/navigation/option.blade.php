@if($show)
	<li class="{{ $class }} ">
		<a href="{{ $url }}" title="Widgets">
			@if(isset($count))<div class="pull-right label label-success">{!! $count !!}</div>@endif
			<em class="{{ $icon }}"></em>
			<span data-localize="sidebar.nav.{{ $caption }}">{{ $caption }}</span>
		</a>
	</li>
@endif


