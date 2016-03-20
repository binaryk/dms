@extends('__layouts.pages.datatable.index')

@section('custom-javascript-files')
	@parent
	<!-- includ js-ul pentru datatable creat dinamic -->
	{!! 
	App\Comptechsoft\Ui\Html\Scripts::make([
		'custom/js/file-types/grid',
		'custom/js/grids/index',
	])->render() 
	!!}
@stop

@section('jquery-document-ready')
	@parent
	var grid  = new gridFileTypes();
	var index = new indexGrid({
		grid       : grid,
		toolbar    : '{!! $toolbar !!}',
		_token     : '{{ csrf_token() }}',
		form_width : 4
	}).init();
@stop
