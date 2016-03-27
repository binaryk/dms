@extends('__layouts.pages.datatable.index')

@section('custom-javascript-files')
	@parent
	<!-- includ js-ul pentru datatable creat dinamic -->
	{!! 
	App\Comptechsoft\Ui\Html\Scripts::make([
		'custom/js/search/grid',
		'custom/js/grids/index',
		'custom/js/director-files/file',
	])->render() 
	!!}
@stop

@section('jquery-document-ready')
	@parent
	var grid  = new gridSearch();
	var index = new indexGrid({
		grid       : grid,
		toolbar    : '{!! $toolbar !!}',
		_token     : '{{ csrf_token() }}',
		form_width : 4
	}).init();
	new App.Handler();
@stop
