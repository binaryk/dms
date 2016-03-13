<th id="{{$id}}" class="{{$class}}" style="{{ $style }}">
	<div class="row no-gap">
		<div class="col-xs-12">
			{!! $caption !!}
		</div>
		@if($search)
			<div class="col-xs-12">
				{!! $search !!}
			</div>
		@endif
	</div>
</th>