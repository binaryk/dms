@extends('__layouts.pages.datatable.index')

@section('custom-javascript-files')
	@parent
	<!-- includ js-ul pentru datatable creat dinamic -->
	{!! 
	App\Comptechsoft\Ui\Html\Scripts::make([
		'custom/js/ps/grid_vehicles/grid',
		'custom/js/grids/index',
	])->render()
	!!}
@stop

@section('content')
    @parent
@stop

@section('jquery-document-ready')
	@parent
	var grid  = new gridVehicles();
	var index = new indexGrid({
		grid       : grid,
		toolbar    : '{!! $toolbar !!}',
		_token     : '{{ csrf_token() }}',
		form_width : 6
	}).init();
@stop
