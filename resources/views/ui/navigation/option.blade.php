@if($show)
	<li class="{{ $class }}">
	    <a href="{{ $url }}">
	        <span class="{{ $icon }}"></span><span class="title">{{ $caption }}</span>
	    </a>
	</li>
@endif